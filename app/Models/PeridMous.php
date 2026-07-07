<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeridMous extends Model
{
    use HasFactory;

    protected $table = 'perid_mous';

    protected $primaryKey = 'id_mous';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_mous',
        'hostname',
        'sn',
        'barcode',
        'id_asset_category',
        'category',
        'brand',
        'type',
        'casing',
        'connection',
        'conditions',
        'sub_con',
        'note_con',
        'solution',
        'note_sol',
        'functions',
        'note_func',
        'history_pic',
        'location',
        'note_loc',
        'status',
        'pic_nip',
        'pic_name',
        'total_maintenance_corr',
        'last_maintenance_corr',
        'total_maintenance_prev',
        'last_maintenance_prev',
        'total_maintenance_pred',
        'last_maintenance_pred',
    ];
}
