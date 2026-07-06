<?php

namespace Database\Seeders;

use App\Models\CompdLapt;
use Illuminate\Database\Seeder;

class CompdLaptSeeder extends Seeder
{
    public function run(): void
    {
        CompdLapt::factory()->count(25)->create();

        CompdLapt::factory()->inUse()->create([
            'id_lapt' => 'COMPD.LAPT-0001',
            'hostname' => 'O99-ITD-NB012',
            'sn' => 'JSBKWS2',
            'barcode' => 'MASHQEQP2000002',
            'brand' => 'DELL',
            'type' => 'Latitude 3490',
            'processors' => 'i5-8250U',
            'gen' => 8,
            'ram_cap' => 16,
            'ram_slot' => '2 of 2',
            'ram_type' => 'DDR4, SO-DIMM, 2400 / 2667 Mhz',
            'disk1_cap' => 256,
            'disk1_type' => 'SSD M.2/KYO Kaizen',
            'disk2_cap' => 1000,
            'disk2_type' => 'HDD SATA 2.5"/Toshiba MQ01ABD100',
            'os' => 'WINDOWS',
            'os_type' => 'Windows 11 Pro',
            'os_ver' => '24H2',
            'product_id' => '00330-71290-00002-AAOEM',
            'product_key' => 'TBD',
            'bh' => 75.50,
            'dc' => 50000,
            'fcc' => 37750,
            'sub_con' => 'NORMAL',
            'note_con' => 'Hardware : Need to be Upgrade Performance',
            'solution' => 'KEEP',
            'note_sol' => 'No Solutions, Keep using.',
            'functions' => 'PERSONAL',
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
