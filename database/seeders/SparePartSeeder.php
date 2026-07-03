<?php

namespace Database\Seeders;

use App\Models\SparePart;
use Illuminate\Database\Seeder;

class SparePartSeeder extends Seeder
{
    public function run(): void
    {
        $parts = [
            ['name' => 'Power Supply 500W', 'part_number' => 'PS-500W', 'quantity' => 5, 'minimum_stock' => 2, 'unit_price' => 120000],
            ['name' => 'DDR4 RAM 16GB', 'part_number' => 'RAM-D4-16', 'quantity' => 10, 'minimum_stock' => 3, 'unit_price' => 85000],
            ['name' => 'DDR4 RAM 32GB', 'part_number' => 'RAM-D4-32', 'quantity' => 3, 'minimum_stock' => 2, 'unit_price' => 165000],
            ['name' => 'Samsung SSD 1TB', 'part_number' => 'SSD-1TB', 'quantity' => 8, 'minimum_stock' => 3, 'unit_price' => 250000],
            ['name' => 'Laptop Battery', 'part_number' => 'BAT-LP', 'quantity' => 4, 'minimum_stock' => 2, 'unit_price' => 200000],
            ['name' => 'Thermal Paste', 'part_number' => 'TH-PASTE', 'quantity' => 20, 'minimum_stock' => 5, 'unit_price' => 25000],
            ['name' => 'Cat6 Ethernet Cable 3m', 'part_number' => 'CAT6-3M', 'quantity' => 30, 'minimum_stock' => 10, 'unit_price' => 35000],
            ['name' => 'Keyboard USB', 'part_number' => 'KB-USB', 'quantity' => 15, 'minimum_stock' => 5, 'unit_price' => 75000],
        ];

        foreach ($parts as $part) {
            SparePart::create($part);
        }
    }
}
