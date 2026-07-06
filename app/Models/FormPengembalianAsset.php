<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormPengembalianAsset extends Model
{
    protected $table = 'form_pengembalian_asset';

    protected $fillable = [
        'no_form', 'asset_name', 'pengembali', 'tanggal_kembali',
        'kondisi', 'keterangan', 'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
