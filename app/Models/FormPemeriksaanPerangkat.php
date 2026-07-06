<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormPemeriksaanPerangkat extends Model
{
    protected $table = 'form_pemeriksaan_perangkat';

    protected $fillable = [
        'no_form', 'kategori_asset', 'device_name', 'tanggal_pemeriksaan', 'pemeriksa',
        'hasil_pemeriksaan', 'keterangan', 'form_data', 'user_id',
    ];

    protected function casts(): array
    {
        return [
            'form_data' => 'array',
            'tanggal_pemeriksaan' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
