<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = [
            [
                'user_id' => 2, 'device_id' => 4, 'title' => 'Laptop overheating',
                'description' => 'Lenovo ThinkPad X1 gets very hot during normal use. Fan is loud and system throttles.',
                'status' => 'open', 'priority' => 'high', 'assigned_to' => 1,
            ],
            [
                'user_id' => 2, 'device_id' => 2, 'title' => 'PC won\'t boot',
                'description' => 'HP EliteDesk 800 shows black screen on startup. No POST beeps detected.',
                'status' => 'in_progress', 'priority' => 'urgent', 'assigned_to' => 1,
            ],
            [
                'user_id' => 3, 'device_id' => 5, 'title' => 'Printer paper jam',
                'description' => 'HP LaserJet Pro keeps showing paper jam error even after clearing the tray.',
                'status' => 'open', 'priority' => 'low', 'assigned_to' => null,
            ],
            [
                'user_id' => 3, 'device_id' => 7, 'title' => 'Server performance degradation',
                'description' => 'Dell PowerEdge R740 is running slower than usual. High memory usage observed.',
                'status' => 'in_progress', 'priority' => 'high', 'assigned_to' => 1,
            ],
            [
                'user_id' => 2, 'device_id' => 3, 'title' => 'Battery replacement needed',
                'description' => 'MacBook Pro battery drains quickly. Health at 72%. Requesting replacement.',
                'status' => 'closed', 'priority' => 'medium', 'assigned_to' => 1,
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
