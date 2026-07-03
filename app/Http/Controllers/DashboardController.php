<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Device;
use App\Models\MaintenanceLog;
use App\Models\SparePart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_devices' => Device::count(),
            'available_devices' => Device::where('status', 'available')->count(),
            'in_use_devices' => Device::where('status', 'in_use')->count(),
            'under_maintenance_devices' => Device::where('status', 'under_maintenance')->count(),
            'total_tickets' => Ticket::count(),
            'open_tickets' => Ticket::where('status', 'open')->count(),
            'in_progress_tickets' => Ticket::where('status', 'in_progress')->count(),
            'resolved_tickets' => Ticket::where('status', 'resolved')->count(),
            'closed_tickets' => Ticket::where('status', 'closed')->count(),
            'total_maintenance_logs' => MaintenanceLog::count(),
            'total_maintenance_cost' => MaintenanceLog::sum('cost'),
            'total_users' => User::count(),
            'low_stock_parts' => SparePart::whereColumn('quantity', '<=', 'minimum_stock')->count(),
        ];

        $recentTickets = Ticket::with(['user', 'device'])
            ->latest()
            ->take(5)
            ->get();

        $recentLogs = MaintenanceLog::with(['device', 'user'])
            ->latest()
            ->take(5)
            ->get();

        $deviceStatuses = Device::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $ticketStatuses = Ticket::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $myTickets = collect();
        if (Auth::user()->role === 'user') {
            $myTickets = Ticket::where('user_id', Auth::id())->latest()->take(5)->get();
        }

        return view('dashboard', compact(
            'stats', 'recentTickets', 'recentLogs',
            'deviceStatuses', 'ticketStatuses', 'myTickets'
        ));
    }
}
