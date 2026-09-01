<?php

namespace App\Services;

use App\Events\QueueCalled;
use App\Models\Queue;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class QueueService
{
    /**
     * Memanggil antrean berikutnya untuk jenis layanan tertentu.
     */
    public function callNextQueue($counterId, $serviceId): ?Queue
    {
        $batch = $this->callNextBatchQueue($counterId, $serviceId, 1);

        return $batch[0] ?? null;
    }

    /**
     * Memanggil beberapa antrean sekaligus secara bersamaan (batch call).
     *
     * @return array<int, Queue>
     */
    public function callNextBatchQueue($counterId, $serviceId, int $count = 1): array
    {
        $count = max(1, min($count, 20));
        $today = Carbon::today();

        $lastQueue = Queue::where('service_id', $serviceId)
            ->whereDate('created_at', $today)
            ->orderBy('id', 'desc')
            ->first();

        // Ambil kode layanan (misal: KTP)
        $service = Service::find($serviceId);
        $prefix = $service ? $service->code : 'A';

        $lastNumber = 0;
        if ($lastQueue) {
            $parts = explode('-', $lastQueue->number);
            $lastNumber = isset($parts[1]) ? (int) $parts[1] : 0;
        }

        $now = now();
        $createdQueues = [];

        for ($i = 0; $i < $count; $i++) {
            $nextNumber = $lastNumber + 1 + $i;
            $queueNumber = $prefix.'-'.$nextNumber;

            $queue = Queue::create([
                'number' => $queueNumber,
                'service_id' => $serviceId,
                'counter_id' => $counterId,
                'status' => 'CALLED',
                'called_at' => $now,
            ]);

            $queue->load(['counter', 'service']);
            $createdQueues[] = $queue;
        }

        if (! empty($createdQueues)) {
            try {
                event(new QueueCalled($createdQueues[0], $createdQueues));
            } catch (\Throwable $e) {
                Log::warning('Gagal melakukan broadcast antrean ke Reverb: '.$e->getMessage());
            }
        }

        return $createdQueues;
    }

    /**
     * Memanggil ulang satu antrean.
     */
    public function recallQueue(Queue $queue): Queue
    {
        $this->recallBatchQueues([$queue]);

        return $queue;
    }

    /**
     * Memanggil ulang kumpulan antrean yang sedang aktif bersamaan.
     *
     * @param  array<int, Queue>  $queues
     * @return array<int, Queue>
     */
    public function recallBatchQueues(array $queues): array
    {
        $now = now();
        $updatedQueues = [];

        foreach ($queues as $queue) {
            if ($queue instanceof Queue) {
                $queue->update([
                    'status' => 'CALLED',
                    'called_at' => $now,
                ]);
                $queue->load(['counter', 'service']);
                $updatedQueues[] = $queue;
            }
        }

        if (! empty($updatedQueues)) {
            try {
                event(new QueueCalled($updatedQueues[0], $updatedQueues));
            } catch (\Throwable $e) {
                Log::warning('Gagal melakukan broadcast antrean ke Reverb: '.$e->getMessage());
            }
        }

        return $updatedQueues;
    }

    /**
     * Selesaikan satu antrean.
     */
    public function completeQueue(Queue $queue): Queue
    {
        $queue->update([
            'status' => 'COMPLETED',
            'completed_at' => now(),
        ]);

        return $queue;
    }

    /**
     * Selesaikan kumpulan antrean batch sekaligus.
     *
     * @param  array<int, Queue>  $queues
     */
    public function completeBatchQueues(array $queues): void
    {
        $now = now();
        foreach ($queues as $queue) {
            if ($queue instanceof Queue) {
                $queue->update([
                    'status' => 'COMPLETED',
                    'completed_at' => $now,
                ]);
            }
        }
    }

    /**
     * Lewati satu antrean.
     */
    public function skipQueue(Queue $queue): Queue
    {
        $queue->update([
            'status' => 'SKIPPED',
        ]);

        return $queue;
    }

    /**
     * Lewati kumpulan antrean batch sekaligus.
     *
     * @param  array<int, Queue>  $queues
     */
    public function skipBatchQueues(array $queues): void
    {
        foreach ($queues as $queue) {
            if ($queue instanceof Queue) {
                $queue->update([
                    'status' => 'SKIPPED',
                ]);
            }
        }
    }

    /**
     * Memanggil antrean berdasarkan nomor spesifik.
     */
    public function callSpecificQueue(string $number, int $counterId, int $serviceId): ?Queue
    {
        $queue = Queue::where('number', $number)
            ->where('service_id', $serviceId)
            ->whereIn('status', ['WAITING', 'SERVING', 'COMPLETED'])
            ->first();

        if (! $queue) {
            return null;
        }

        $queue->update([
            'status' => 'CALLED',
            'counter_id' => $counterId,
            'called_at' => now(),
            'completed_at' => null,
        ]);

        $queue->load(['counter', 'service']);

        try {
            event(new QueueCalled($queue));
        } catch (\Throwable $e) {
            Log::warning('Gagal melakukan broadcast antrean ke Reverb: '.$e->getMessage());
        }

        return $queue;
    }
}
