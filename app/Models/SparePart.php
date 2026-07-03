<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SparePart extends Model
{
    protected $fillable = [
        'name', 'part_number', 'quantity', 'minimum_stock', 'unit_price',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
        ];
    }

    public function maintenanceLogs(): BelongsToMany
    {
        return $this->belongsToMany(MaintenanceLog::class, 'maintenance_log_spare_part')
            ->withPivot('quantity_used')
            ->withTimestamps();
    }
}
