<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormPemeriksaanPerangkat extends Model
{
    protected $table = 'form_pemeriksaan_perangkat';

    protected $fillable = [
        'no_form', 'device_name', 'tanggal_pemeriksaan', 'pemeriksa',
        'hasil_pemeriksaan', 'keterangan', 'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
