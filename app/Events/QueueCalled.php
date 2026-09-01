<?php

namespace App\Events;

use App\Models\Queue;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QueueCalled implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Queue $queue;

    /**
     * @var array<int, Queue>
     */
    public array $queues = [];

    /**
     * Create a new event instance.
     *
     * @param  array<int, Queue>  $queues
     */
    public function __construct(Queue $queue, array $queues = [])
    {
        $this->queue = $queue;
        $this->queues = ! empty($queues) ? $queues : [$queue];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('public-display'),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'QueueCalled';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        $numbers = array_map(function ($q) {
            return $q instanceof Queue ? $q->number : ($q['number'] ?? '');
        }, $this->queues);

        natsort($numbers);
        $numbers = array_values($numbers);

        $displayNumber = $this->queue->number;
        if (count($numbers) > 1) {
            $displayNumber = $numbers[0].' s.d. '.end($numbers);
        }

        return [
            'queue' => $this->queue->loadMissing(['counter', 'service'])->toArray(),
            'numbers' => $numbers,
            'display_number' => $displayNumber,
            'count' => count($numbers),
        ];
    }
}
