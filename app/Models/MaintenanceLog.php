<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MaintenanceLog extends Model
{
    protected $fillable = [
        'ticket_id', 'device_id', 'user_id', 'maintenance_type',
        'description', 'cost', 'performed_at',
    ];

    protected function casts(): array
    {
        return [
            'cost' => 'decimal:2',
            'performed_at' => 'date',
        ];
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function spareParts(): BelongsToMany
    {
        return $this->belongsToMany(SparePart::class, 'maintenance_log_spare_part')
            ->withPivot('quantity_used')
            ->withTimestamps();
    }
}
