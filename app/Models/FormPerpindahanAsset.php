<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormPerpindahanAsset extends Model
{
    protected $table = 'form_perpindahan_asset';

    protected $fillable = [
        'no_form', 'asset_name', 'tanggal_pindah', 'dari_lokasi',
        'ke_lokasi', 'penanggung_jawab', 'keterangan', 'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
