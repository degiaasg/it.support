<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\MaintenanceLog;
use App\Models\Ticket;
use App\Models\SparePart;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function devices(Request $request)
    {
        $query = Device::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $devices = $query->get();
        $categories = \App\Models\Category::pluck('name', 'id');

        return view('reports.devices', compact('devices', 'categories'));
    }

    public function maintenance(Request $request)
    {
        $query = MaintenanceLog::with(['device', 'user', 'ticket']);

        if ($request->filled('date_from')) {
            $query->whereDate('performed_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('performed_at', '<=', $request->date_to);
        }
        if ($request->filled('device_id')) {
            $query->where('device_id', $request->device_id);
        }

        $logs = $query->latest()->get();
        $devices = Device::pluck('name', 'id');
        $totalCost = $logs->sum('cost');

        return view('reports.maintenance', compact('logs', 'devices', 'totalCost'));
    }

    public function tickets(Request $request)
    {
        $query = Ticket::with(['user', 'device', 'assignedTo']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $tickets = $query->latest()->get();

        return view('reports.tickets', compact('tickets'));
    }

    public function exportDevices(Request $request)
    {
        $query = Device::with('category');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $devices = $query->get();

        $pdf = Pdf::loadView('reports.pdf.devices', compact('devices'));
        return $pdf->download('laporan-perangkat-' . date('Y-m-d') . '.pdf');
    }

    public function exportMaintenance(Request $request)
    {
        $query = MaintenanceLog::with(['device', 'user']);
        if ($request->filled('date_from')) {
            $query->whereDate('performed_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('performed_at', '<=', $request->date_to);
        }
        $logs = $query->latest()->get();
        $totalCost = $logs->sum('cost');

        $pdf = Pdf::loadView('reports.pdf.maintenance', compact('logs', 'totalCost'));
        return $pdf->download('laporan-maintenance-' . date('Y-m-d') . '.pdf');
    }

    public function exportTickets(Request $request)
    {
        $query = Ticket::with(['user', 'device', 'assignedTo']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $tickets = $query->latest()->get();

        $pdf = Pdf::loadView('reports.pdf.tickets', compact('tickets'));
        return $pdf->download('laporan-tiket-' . date('Y-m-d') . '.pdf');
    }
}
