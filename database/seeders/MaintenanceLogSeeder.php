<?php

namespace Database\Seeders;

use App\Models\MaintenanceLog;
use Illuminate\Database\Seeder;

class MaintenanceLogSeeder extends Seeder
{
    public function run(): void
    {
        $logs = [
            [
                'ticket_id' => 2, 'device_id' => 2, 'user_id' => 1,
                'maintenance_type' => 'corrective', 'description' => 'Replaced faulty power supply unit. System now boots normally.',
                'cost' => 150000, 'performed_at' => '2025-06-28',
            ],
            [
                'ticket_id' => 5, 'device_id' => 3, 'user_id' => 1,
                'maintenance_type' => 'corrective', 'description' => 'Replaced battery. Calibrated new battery. Health now at 100%.',
                'cost' => 250000, 'performed_at' => '2025-06-25',
            ],
            [
                'ticket_id' => null, 'device_id' => 1, 'user_id' => 1,
                'maintenance_type' => 'preventive', 'description' => 'Monthly cleaning and diagnostics. Firmware updated. All OK.',
                'cost' => 50000, 'performed_at' => '2025-06-20',
            ],
            [
                'ticket_id' => 4, 'device_id' => 7, 'user_id' => 1,
                'maintenance_type' => 'emergency', 'description' => 'RAM upgrade from 32GB to 64GB. Cleaned dust from heatsinks. Performance restored.',
                'cost' => 350000, 'performed_at' => '2025-06-26',
            ],
        ];

        foreach ($logs as $log) {
            MaintenanceLog::create($log);
        }
    }
}
