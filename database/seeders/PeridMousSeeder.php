<?php

namespace Database\Seeders;

use App\Models\PeridMous;
use Illuminate\Database\Seeder;

class PeridMousSeeder extends Seeder
{
    public function run(): void
    {
        PeridMous::factory()->count(25)->create();

        PeridMous::factory()->inUse()->create([
            'id_mous' => 'PERID.MOUS-0001',
            'hostname' => 'O99-ITD-NB012',
            'sn' => '1802LZ0wQN48',
            'barcode' => 'MASHQEQP2000002',
            'brand' => 'Logitech',
            'type' => 'M221',
            'casing' => 'GOOD',
            'connection' => 'Wireless USB',
            'conditions' => 'GOOD',
            'sub_con' => 'NORMAL',
            'note_con' => 'Hardware : Need to be Upgrade Performance',
            'solution' => 'KEEP',
            'note_sol' => 'No Solutions, Keep using.',
            'functions' => 'PERUSED',
            'note_func' => 'Personal use for work.',
            'history_pic' => 'Degia Parlopa; Stanley Wijaya',
            'location' => 'USER',
            'note_loc' => 'USER',
            'status' => 'IN USE',
            'pic_nip' => 221284,
            'pic_name' => 'Degia Parlopa',
            'total_maintenance_corr' => 2,
            'last_maintenance_corr' => '2026-06-07',
            'total_maintenance_prev' => 1,
            'last_maintenance_prev' => '2026-06-08',
            'total_maintenance_pred' => 0,
        ]);
    }
}
