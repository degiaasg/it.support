<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormPerawatanPerangkat extends Model
{
    protected $table = 'form_perawatan_perangkat';

    protected $fillable = [
        'no_form', 'device_name', 'tanggal_perawatan', 'jenis_perawatan',
        'petugas', 'biaya', 'keterangan', 'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
