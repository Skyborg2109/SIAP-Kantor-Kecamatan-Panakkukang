<?php

namespace App\Livewire;

use App\Models\Announcement;
use App\Models\Queue;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.display')]
class PublicDisplay extends Component
{
    private const QUEUE_TYPES = ['KTP', 'IKD'];

    public $latestCall = null;

    public $lastCalledQueueId = null;

    public $lastCalledAt = null;

    public function mount(): void
    {
        $current = $this->activeQueues->first();
        if ($current) {
            $this->lastCalledQueueId = $current->id;
            $this->lastCalledAt = $current->called_at?->toIso8601String() ?? $current->updated_at?->toIso8601String();

            $batch = $this->latestBatch;
            $numbers = $batch->sortBy('id')->pluck('number')->values()->all();

            $this->latestCall = [
                'queue' => $current->toArray(),
                'numbers' => $numbers,
                'display_number' => count($numbers) > 1 ? $numbers[0].' s.d. '.end($numbers) : $current->number,
                'count' => count($numbers),
            ];
        }
    }

    public function getActiveQueuesProperty()
    {
        return Queue::with(['counter', 'service'])
            ->whereIn('status', ['CALLED', 'SERVING'])
            ->orderBy('called_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->take(12)
            ->get();
    }

    /**
     * Kumpulan antrean yang dipanggil bersamaan pada batch terakhir (diurutkan dari terkecil ke terbesar).
     */
    public function getLatestBatchProperty()
    {
        $all = $this->activeQueues;
        if ($all->isEmpty()) {
            return collect();
        }

        $latest = $all->first();
        $latestTime = strtotime((string) $latest->called_at);

        return $all->filter(function ($q) use ($latest, $latestTime) {
            return $q->service_id === $latest->service_id
                && abs(strtotime((string) $q->called_at) - $latestTime) <= 2;
        })->sortBy('id')->values();
    }

    public function getAnnouncementsProperty()
    {
        return Announcement::where('status', true)->get();
    }

    /**
     * Mengambil status antrean aktif / terkini per jenis layanan (KTP, IKD).
     *
     * @return Collection<int, array{
     *     id: int,
     *     name: string,
     *     code: string,
     *     description: string|null,
     *     is_active: bool,
     *     status_label: string,
     *     display_number: string,
     *     count: int,
     *     numbers: array<int, string>,
     *     batch: Collection<int, Queue>
     * }>
     */
    public function getServiceStatusesProperty(): Collection
    {
        $serviceOrder = array_flip(self::QUEUE_TYPES);

        $services = Service::query()
            ->where('status', true)
            ->whereIn('code', self::QUEUE_TYPES)
            ->get()
            ->sortBy(fn (Service $service): int => $serviceOrder[$service->code])
            ->values();

        if ($services->isEmpty()) {
            return collect();
        }

        $today = Carbon::today();

        $queuesByService = Queue::query()
            ->whereIn('service_id', $services->modelKeys())
            ->where(function (Builder $query) use ($today) {
                $query->whereIn('status', ['CALLED', 'SERVING'])
                    ->orWhereDate('created_at', $today);
            })
            ->orderBy('called_at', 'desc')
            ->orderBy('id', 'desc')
            ->get()
            ->groupBy('service_id');

        return $services->map(function (Service $service) use ($queuesByService) {
            /** @var Collection<int, Queue> $serviceQueues */
            $serviceQueues = $queuesByService->get($service->id, collect());
            $activeQueues = $serviceQueues->whereIn('status', ['CALLED', 'SERVING'])->values();

            if ($activeQueues->isNotEmpty()) {
                $latestCalledAt = $activeQueues->first()->called_at;
                $batch = $activeQueues->filter(function ($q) use ($latestCalledAt) {
                    return abs(strtotime((string) $q->called_at) - strtotime((string) $latestCalledAt)) <= 2;
                })->sortBy('id')->values();

                $numbers = $batch->pluck('number')->all();

                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'code' => $service->code,
                    'description' => $service->description,
                    'is_active' => true,
                    'status_label' => 'Sedang Dilayani',
                    'display_number' => count($numbers) > 1 ? $numbers[0].' s.d. '.end($numbers) : $numbers[0],
                    'count' => count($numbers),
                    'numbers' => $numbers,
                    'batch' => $batch,
                ];
            }

            $lastToday = $serviceQueues
                ->filter(fn (Queue $queue): bool => $queue->created_at?->isToday() ?? false)
                ->first();

            if ($lastToday) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'code' => $service->code,
                    'description' => $service->description,
                    'is_active' => false,
                    'status_label' => 'Terakhir Dipanggil',
                    'display_number' => $lastToday->number,
                    'count' => 1,
                    'numbers' => [$lastToday->number],
                    'batch' => collect([$lastToday]),
                ];
            }

            return [
                'id' => $service->id,
                'name' => $service->name,
                'code' => $service->code,
                'description' => $service->description,
                'is_active' => false,
                'status_label' => 'Menunggu Antrean',
                'display_number' => '-',
                'count' => 0,
                'numbers' => [],
                'batch' => collect(),
            ];
        });
    }

    /**
     * Polling fallback method to ensure real-time update even if Reverb drops or is offline.
     */
    public function checkQueueUpdate(): void
    {
        $current = $this->activeQueues->first();
        if (! $current) {
            return;
        }

        $calledAt = $current->called_at?->toIso8601String() ?? $current->updated_at?->toIso8601String();

        if ($current->id !== $this->lastCalledQueueId || $calledAt !== $this->lastCalledAt) {
            $this->lastCalledQueueId = $current->id;
            $this->lastCalledAt = $calledAt;

            $batch = $this->latestBatch;
            $numbers = $batch->sortBy('id')->pluck('number')->values()->all();

            $this->latestCall = [
                'queue' => $current->toArray(),
                'numbers' => $numbers,
                'display_number' => count($numbers) > 1 ? $numbers[0].' s.d. '.end($numbers) : $current->number,
                'count' => count($numbers),
            ];

            $this->dispatch('play-tts', queue: $this->latestCall);
        }
    }

    #[On('echo:public-display,.QueueCalled')]
    #[On('echo:public-display,QueueCalled')]
    #[On('echo:public-display,App\\Events\\QueueCalled')]
    public function notifyNewQueue($data = null): void
    {
        $current = $this->activeQueues->first();
        if ($current) {
            $this->lastCalledQueueId = $current->id;
            $this->lastCalledAt = $current->called_at?->toIso8601String() ?? $current->updated_at?->toIso8601String();

            $batch = $this->latestBatch;
            $numbers = ! empty($data['numbers'])
                ? collect($data['numbers'])->sort(SORT_NATURAL)->values()->all()
                : $batch->sortBy('id')->pluck('number')->values()->all();

            $this->latestCall = [
                'queue' => $data['queue'] ?? $current->toArray(),
                'numbers' => $numbers,
                'display_number' => $data['display_number'] ?? (count($numbers) > 1 ? $numbers[0].' s.d. '.end($numbers) : $current->number),
                'count' => count($numbers),
            ];
        } else {
            $this->latestCall = $data ?? null;
        }

        $this->dispatch('play-tts', queue: $this->latestCall);
    }

    public function clearLatestCall(): void
    {
        $this->latestCall = null;
    }

    public function render()
    {
        return view('livewire.public-display');
    }
}
