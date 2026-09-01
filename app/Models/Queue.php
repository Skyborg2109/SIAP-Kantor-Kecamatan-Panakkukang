<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Queue extends Model
{
    protected $fillable = [
        'number',
        'service_id',
        'counter_id',
        'status',
        'called_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'called_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    /**
     * Get the service associated with the queue.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the counter associated with the queue.
     */
    public function counter(): BelongsTo
    {
        return $this->belongsTo(Counter::class);
    }
}
