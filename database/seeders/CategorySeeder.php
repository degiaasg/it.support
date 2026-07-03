<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Desktop', 'slug' => 'desktop', 'description' => 'Desktop computers and workstations'],
            ['name' => 'Laptop', 'slug' => 'laptop', 'description' => 'Notebooks and portable computers'],
            ['name' => 'Printer', 'slug' => 'printer', 'description' => 'Printers, scanners, and multifunction devices'],
            ['name' => 'Network', 'slug' => 'network', 'description' => 'Networking equipment including routers, switches, and access points'],
            ['name' => 'Server', 'slug' => 'server', 'description' => 'Server hardware and rack equipment'],
            ['name' => 'Peripheral', 'slug' => 'peripheral', 'description' => 'Keyboards, mice, monitors, and other peripherals'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
