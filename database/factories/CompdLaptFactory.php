<?php

namespace Database\Factories;

use App\Models\CompdLapt;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompdLaptFactory extends Factory
{
    protected $model = CompdLapt::class;

    public function definition(): array
    {
        $brands = ['DELL', 'HP', 'LENOVO', 'ACER', 'ASUS', 'APPLE'];
        $brand = $this->faker->randomElement($brands);
        $osTypes = [
            'WINDOWS' => ['Windows 11 Pro', 'Windows 10 Pro', 'Windows 11 Enterprise'],
            'MACHINTOS' => ['macOS Sequoia', 'macOS Sonoma', 'macOS Ventura'],
            'LINUX' => ['Ubuntu 24.04', 'Fedora 40', 'Debian 12'],
        ];
        $os = $this->faker->randomElement(['WINDOWS', 'WINDOWS', 'WINDOWS', 'MACHINTOS', 'LINUX']);
        $osType = $this->faker->randomElement($osTypes[$os]);

        return [
            'id_lapt' => 'COMPD.LAPT-' . str_pad($this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'hostname' => strtoupper($this->faker->bothify('O##-ITD-LAPT###')),
            'sn' => strtoupper($this->faker->bothify('???####')),
            'barcode' => strtoupper($this->faker->bothify('MASH??????????')),
            'id_asset_category' => 'LAPT',
            'category' => 'LAPTOP',
            'brand' => $brand,
            'type' => $brand === 'DELL' ? $this->faker->randomElement(['Latitude 3490', 'Latitude 5420', 'Latitude 7440', 'Precision 3560']) :
                     ($brand === 'HP' ? $this->faker->randomElement(['ProBook 450', 'EliteBook 840', 'Pavilion 15']) :
                     ($brand === 'LENOVO' ? $this->faker->randomElement(['ThinkPad T14', 'ThinkPad X1', 'IdeaPad 5']) :
                     ($brand === 'APPLE' ? $this->faker->randomElement(['MacBook Pro 14"', 'MacBook Air M3']) :
                     $this->faker->randomElement(['Swift 3', 'ZenBook 14', 'ROG Zephyrus'])))),
            'processors' => $this->faker->randomElement(['i5-8250U', 'i5-1135G7', 'i7-1165G7', 'i7-1260P', 'i5-1335U', 'i7-1360P', 'Ryzen 5 5500U', 'Ryzen 7 5800U']),
            'gen' => $this->faker->numberBetween(8, 13),
            'ram_cap' => $this->faker->randomElement([8, 16, 32]),
            'ram_slot' => $this->faker->randomElement(['1 of 1', '1 of 2', '2 of 2']),
            'ram_type' => $this->faker->randomElement(['DDR4, SO-DIMM, 3200MHz', 'DDR5, SO-DIMM, 4800MHz', 'LPDDR5, 6400MHz']),
            'disk1_cap' => $this->faker->randomElement([128, 256, 512, 1024]),
            'disk1_type' => $this->faker->randomElement(['SSD M.2 NVMe', 'SSD M.2 SATA', 'SSD NVMe PCIe Gen4']),
            'disk2_cap' => $this->faker->optional(0.6)->randomElement([500, 1000, 2000]),
            'disk2_type' => $this->faker->optional(0.6)->randomElement(['HDD SATA 2.5"', 'HDD SATA 3.5"', 'SSD SATA 2.5"']),
            'os' => $os,
            'os_type' => $osType,
            'os_ver' => $os === 'WINDOWS' ? $this->faker->randomElement(['21H2', '22H2', '23H2', '24H2']) :
                       ($os === 'MACHINTOS' ? $this->faker->randomElement(['14.0', '14.5', '15.0']) : '24.04'),
            'product_id' => $this->faker->regexify('[0-9]{5}-[0-9]{5}-[0-9]{5}-[A-Z0-9]{5}'),
            'product_key' => strtoupper($this->faker->bothify('?????-?????-?????-?????-?????')),
            'bh' => $this->faker->randomFloat(2, 60, 100),
            'dc' => $this->faker->randomElement([45000, 50000, 55000, 60000]),
            'fcc' => function (array $attrs) { return (int) round($attrs['bh'] / 100 * ($attrs['dc'] ?? 50000)); },
            'casing' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'display' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'port_display' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'keyboard' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'touchpad' => $this->faker->randomElement(['GOOD', 'GOOD', 'BAD']),
            'port_usb' => 'GOOD',
            'port_jeck' => $this->faker->randomElement(['GOOD', 'GOOD', 'BAD']),
            'port_psu' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'fan' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'webcam' => $this->faker->randomElement(['GOOD', 'GOOD', 'BAD']),
            'microfon' => $this->faker->randomElement(['GOOD', 'GOOD', 'BAD']),
            'speaker' => $this->faker->randomElement(['GOOD', 'GOOD', 'BAD']),
            'connection' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'conditions' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'sub_con' => $this->faker->randomElement(['GREAT', 'NORMAL', 'NORMAL', 'CAUTIONS']),
            'note_con' => $this->faker->optional()->sentence(),
            'solution' => $this->faker->randomElement(['KEEP', 'KEEP', 'KEEP', 'UPGRADE', 'REPAIR']),
            'note_sol' => $this->faker->optional()->sentence(),
            'functions' => $this->faker->randomElement(['PERSONAL', 'GROUP', 'SYSTEM', 'OPERATIONAL']),
            'note_func' => $this->faker->sentence(),
            'history_pic' => $this->faker->name() . '; ' . $this->faker->name(),
            'location' => $this->faker->randomElement(['USER', 'IT ROOM', 'SERVER ROOM', 'WORKSHOP']),
            'note_loc' => $this->faker->randomElement(['USER', 'IT ROOM', 'STORAGE']),
            'status' => $this->faker->randomElement(['IN USE', 'IN USE', 'IN USE', 'IN STORE', 'IN REPAIR']),
            'pic_nip' => $this->faker->numberBetween(100000, 999999),
            'pic_name' => $this->faker->name(),
            'total_maintenance_corr' => $this->faker->numberBetween(0, 5),
            'last_maintenance_corr' => $this->faker->optional()->date(),
            'total_maintenance_prev' => $this->faker->numberBetween(0, 3),
            'last_maintenance_prev' => $this->faker->optional()->date(),
            'total_maintenance_pred' => $this->faker->numberBetween(0, 2),
            'last_maintenance_pred' => $this->faker->optional()->date(),
        ];
    }

    public function inUse(): static
    {
        return $this->state(fn(array $attrs) => [
            'status' => 'IN USE',
            'location' => 'USER',
            'note_loc' => 'USER',
        ]);
    }

    public function inStore(): static
    {
        return $this->state(fn(array $attrs) => [
            'status' => 'IN STORE',
            'location' => 'IT ROOM',
            'note_loc' => 'STORAGE',
        ]);
    }
}
