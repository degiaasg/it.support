<?php

namespace Database\Factories;

use App\Models\PeridMous;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeridMousFactory extends Factory
{
    protected $model = PeridMous::class;

    public function definition(): array
    {
        $brands = ['LOGITECH', 'MICROSOFT', 'RAZER', 'HP', 'DELL', 'LENOVO', 'ASUS', 'KINGSTON'];
        $brand = $this->faker->randomElement($brands);
        $connections = ['Wireless USB', 'Bluetooth', 'Wire'];

        return [
            'id_mous' => 'PERID.MOUS-' . str_pad($this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'hostname' => strtoupper($this->faker->bothify('O##-ITD-MOUS###')),
            'sn' => strtoupper($this->faker->bothify('???####')),
            'barcode' => strtoupper($this->faker->bothify('MASH??????????')),
            'id_asset_category' => 'MOUS',
            'category' => 'MOUSE',
            'brand' => $brand,
            'type' => $brand === 'LOGITECH' ? $this->faker->randomElement(['M221', 'M331', 'M585', 'M720', 'MX Master 3S', 'G203', 'G502']) :
                     ($brand === 'MICROSOFT' ? $this->faker->randomElement(['Sculpt Ergo', 'Surface Mobile', 'Modern Mobile', 'Bluetooth Ergo']) :
                     ($brand === 'RAZER' ? $this->faker->randomElement(['DeathAdder V2', 'Basilisk X', 'Orochi V2']) :
                     ($brand === 'HP' ? $this->faker->randomElement(['S1000', 'S1500', '320M']) :
                     ($brand === 'DELL' ? $this->faker->randomElement(['MS116', 'MS3220', 'MS5120W']) :
                     $this->faker->randomElement(['ThinkPad Mouse', 'TUF M3', 'HyperX Pulsefire']))))),
            'casing' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'connection' => $this->faker->randomElement($connections),
            'conditions' => $this->faker->randomElement(['GOOD', 'GOOD', 'GOOD', 'BAD']),
            'sub_con' => $this->faker->randomElement(['GREAT', 'NORMAL', 'NORMAL', 'COUTIONS']),
            'note_con' => $this->faker->optional()->sentence(),
            'solution' => $this->faker->randomElement(['KEEP', 'KEEP', 'KEEP', 'UPGRADE', 'REPAIR']),
            'note_sol' => $this->faker->optional()->sentence(),
            'functions' => $this->faker->randomElement(['PERUSED', 'GROUP', 'SYSTEM', 'OPERATIONAL']),
            'note_func' => $this->faker->sentence(),
            'history_pic' => $this->faker->name() . '; ' . $this->faker->name(),
            'location' => $this->faker->randomElement(['USER', 'IT ROOM', 'WORKSHOP', 'STORE']),
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
