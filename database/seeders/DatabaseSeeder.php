<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'phone' => '081234567890',
            'position' => 'IT Manager',
        ]);

        User::factory()->create([
            'name' => 'Teknisi',
            'email' => 'teknisi@example.com',
            'role' => 'technician',
            'phone' => '081234567891',
            'position' => 'IT Support',
        ]);

        User::factory()->create([
            'name' => 'User Biasa',
            'email' => 'user@example.com',
            'role' => 'user',
            'phone' => '081234567892',
            'position' => 'Staff',
        ]);

        $this->call([
            CategorySeeder::class,
            DeviceSeeder::class,
            TicketSeeder::class,
            MaintenanceLogSeeder::class,
            SparePartSeeder::class,
            CompdLaptSeeder::class,
            PeridMousSeeder::class,
        ]);
    }
}
