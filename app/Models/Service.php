<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'requirements',
        'procedure',
        'status',
    ];

    /**
     * Get the queues for this service.
     */
    public function queues(): HasMany
    {
        return $this->hasMany(Queue::class);
    }
}
