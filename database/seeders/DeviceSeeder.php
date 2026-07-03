<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        $devices = [
            ['category_id' => 1, 'name' => 'Dell OptiPlex 7090', 'brand' => 'Dell', 'model' => 'OptiPlex 7090', 'serial_number' => 'SN-001', 'status' => 'available'],
            ['category_id' => 1, 'name' => 'HP EliteDesk 800', 'brand' => 'HP', 'model' => 'EliteDesk 800 G6', 'serial_number' => 'SN-002', 'status' => 'in_use'],
            ['category_id' => 2, 'name' => 'MacBook Pro 16"', 'brand' => 'Apple', 'model' => 'MacBook Pro 2023', 'serial_number' => 'SN-003', 'status' => 'in_use'],
            ['category_id' => 2, 'name' => 'Lenovo ThinkPad X1', 'brand' => 'Lenovo', 'model' => 'ThinkPad X1 Carbon Gen 11', 'serial_number' => 'SN-004', 'status' => 'under_maintenance'],
            ['category_id' => 3, 'name' => 'HP LaserJet Pro', 'brand' => 'HP', 'model' => 'LaserJet Pro M404dn', 'serial_number' => 'SN-005', 'status' => 'available'],
            ['category_id' => 4, 'name' => 'Cisco Catalyst 9200', 'brand' => 'Cisco', 'model' => 'Catalyst 9200', 'serial_number' => 'SN-006', 'status' => 'in_use'],
            ['category_id' => 5, 'name' => 'Dell PowerEdge R740', 'brand' => 'Dell', 'model' => 'PowerEdge R740', 'serial_number' => 'SN-007', 'status' => 'in_use'],
            ['category_id' => 6, 'name' => 'Dell UltraSharp 27"', 'brand' => 'Dell', 'model' => 'UltraSharp U2723QE', 'serial_number' => 'SN-008', 'status' => 'available'],
        ];

        foreach ($devices as $device) {
            Device::create($device);
        }
    }
}
