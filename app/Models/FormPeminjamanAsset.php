<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormPeminjamanAsset extends Model
{
    protected $table = 'form_peminjaman_asset';

    protected $fillable = [
        'no_form', 'asset_name', 'peminjam', 'tanggal_pinjam',
        'tanggal_rencana_kembali', 'keperluan', 'status', 'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
