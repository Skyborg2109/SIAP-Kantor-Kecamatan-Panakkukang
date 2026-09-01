<?php

namespace App\Livewire;

use App\Models\Queue;
use App\Models\Service;
use App\Services\QueueService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PetugasDashboard extends Component
{
    private const QUEUE_TYPES = ['KTP', 'IKD'];

    public $counter;

    /**
     * @var array<int, array<int, Queue>>
     */
    public array $activeBatchQueuesByService = [];

    /**
     * @var array<int, int>
     */
    public array $batchCounts = [];

    public string $specificNumber = '';

    public ?int $specificServiceId = null;

    public function mount(): void
    {
        $this->counter = auth()->user()->counter;
        $this->loadActiveQueues();
    }

    public function loadActiveQueues(): void
    {
        $this->activeBatchQueuesByService = [];

        if (! $this->counter) {
            return;
        }

        $activeQueues = Queue::query()
            ->with('service')
            ->where('counter_id', $this->counter->id)
            ->whereIn('status', ['CALLED', 'SERVING'])
            ->orderBy('called_at', 'desc')
            ->orderBy('id', 'desc')
            ->get()
            ->groupBy('service_id');

        foreach ($activeQueues as $serviceId => $serviceQueues) {
            $this->activeBatchQueuesByService[(int) $serviceId] = $this->activeBatchForService($serviceQueues);
        }
    }

    /**
     * @param  Collection<int, Queue>  $serviceQueues
     * @return array<int, Queue>
     */
    private function activeBatchForService(Collection $serviceQueues): array
    {
        $latestCalledAt = $serviceQueues->first()?->called_at;

        return $serviceQueues
            ->filter(function (Queue $queue) use ($latestCalledAt): bool {
                return $latestCalledAt !== null
                    && $queue->called_at !== null
                    && abs($queue->called_at->diffInSeconds($latestCalledAt)) <= 2;
            })
            ->values()
            ->all();
    }

    public function incrementBatch($serviceId): void
    {
        $current = $this->batchCounts[$serviceId] ?? 1;
        if ($current < 10) {
            $this->batchCounts[$serviceId] = $current + 1;
        }
    }

    public function decrementBatch($serviceId): void
    {
        $current = $this->batchCounts[$serviceId] ?? 1;
        if ($current > 1) {
            $this->batchCounts[$serviceId] = $current - 1;
        }
    }

    public function callNext(QueueService $queueService, int $serviceId): void
    {
        if (! $this->counter) {
            return;
        }

        $count = $this->batchCounts[$serviceId] ?? 1;
        $activeBatchQueues = $this->activeBatchQueuesByService[$serviceId] ?? [];

        if (! empty($activeBatchQueues)) {
            $queueService->completeBatchQueues($activeBatchQueues);
        }

        $queues = $queueService->callNextBatchQueue($this->counter->id, $serviceId, $count);

        if (! empty($queues)) {
            $this->activeBatchQueuesByService[$serviceId] = $queues;

            if (count($queues) > 1) {
                $numbers = array_map(fn ($q) => $q->number, $queues);
                session()->flash('success', count($queues).' antrean sekaligus ('.implode(', ', $numbers).') berhasil dipanggil.');
            } else {
                session()->flash('success', 'Antrean '.$queues[0]->number.' dipanggil.');
            }
        } else {
            unset($this->activeBatchQueuesByService[$serviceId]);
            session()->flash('error', 'Tidak ada antrean menunggu.');
        }
    }

    public function recallService(QueueService $queueService, int $serviceId): void
    {
        $activeBatchQueues = $this->activeBatchQueuesByService[$serviceId] ?? [];

        if (empty($activeBatchQueues)) {
            return;
        }

        $this->activeBatchQueuesByService[$serviceId] = $queueService->recallBatchQueues($activeBatchQueues);
        $numbers = array_map(fn (Queue $queue): string => $queue->number, $activeBatchQueues);
        session()->flash('success', 'Antrean ('.implode(', ', $numbers).') berhasil dipanggil ulang.');
    }

    public function completeService(QueueService $queueService, int $serviceId): void
    {
        $activeBatchQueues = $this->activeBatchQueuesByService[$serviceId] ?? [];

        if (empty($activeBatchQueues)) {
            return;
        }

        $queueService->completeBatchQueues($activeBatchQueues);
        unset($this->activeBatchQueuesByService[$serviceId]);
        session()->flash('success', count($activeBatchQueues).' antrean telah selesai dilayani.');
    }

    public function skipService(QueueService $queueService, int $serviceId): void
    {
        $activeBatchQueues = $this->activeBatchQueuesByService[$serviceId] ?? [];

        if (empty($activeBatchQueues)) {
            return;
        }

        $queueService->skipBatchQueues($activeBatchQueues);
        unset($this->activeBatchQueuesByService[$serviceId]);
        session()->flash('success', count($activeBatchQueues).' antrean dilewati.');
    }

    public function setSpecificService(int $serviceId): void
    {
        $this->specificServiceId = $serviceId;
        $this->specificNumber = '';
    }

    public function callSpecific(QueueService $queueService): void
    {
        if (! $this->counter || $this->specificNumber === '' || $this->specificServiceId === null) {
            return;
        }

        $service = Service::find($this->specificServiceId);
        if (! $service) {
            return;
        }

        $number = $service->code.'-'.preg_replace('/[^0-9]/', '', $this->specificNumber);

        $queue = $queueService->callSpecificQueue($number, $this->counter->id, $this->specificServiceId);

        if ($queue) {
            $activeBatchQueues = $this->activeBatchQueuesByService[$queue->service_id] ?? [];
            if (! empty($activeBatchQueues)) {
                $queueService->completeBatchQueues($activeBatchQueues);
            }

            $this->activeBatchQueuesByService[$queue->service_id] = [$queue];
            $this->specificNumber = '';
            $this->specificServiceId = null;
            session()->flash('success', 'Antrean '.$queue->number.' berhasil dipanggil.');
        } else {
            session()->flash('error', 'Nomor antrean "'.$number.'" tidak ditemukan atau statusnya bukan WAITING.');
        }
    }

    public function render()
    {
        $serviceOrder = array_flip(self::QUEUE_TYPES);

        $services = Service::query()
            ->where('status', true)
            ->whereIn('code', self::QUEUE_TYPES)
            ->get()
            ->sortBy(fn (Service $service): int => $serviceOrder[$service->code])
            ->values();

        return view('livewire.petugas-dashboard', [
            'services' => $services,
        ]);
    }
}
