<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompdLapt extends Model
{
    use HasFactory;

    protected $table = 'compd_lapt';

    protected $primaryKey = 'id_lapt';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_lapt',
        'hostname',
        'sn',
        'barcode',
        'id_asset_category',
        'category',
        'brand',
        'type',
        'processors',
        'gen',
        'ram_cap',
        'ram_slot',
        'ram_type',
        'disk1_cap',
        'disk1_type',
        'disk2_cap',
        'disk2_type',
        'os',
        'os_type',
        'os_ver',
        'product_id',
        'product_key',
        'bh',
        'dc',
        'fcc',
        'casing',
        'display',
        'port_display',
        'keyboard',
        'touchpad',
        'port_usb',
        'port_jeck',
        'port_psu',
        'fan',
        'webcam',
        'microfon',
        'speaker',
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
