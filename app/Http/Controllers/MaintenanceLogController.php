<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceLog;
use App\Models\Ticket;
use App\Models\Device;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceLogController extends Controller
{
    public function index(Request $request)
    {
        $query = MaintenanceLog::with(['device', 'user', 'ticket']);

        if ($request->filled('maintenance_type')) {
            $query->where('maintenance_type', $request->maintenance_type);
        }

        if ($request->filled('device_id')) {
            $query->where('device_id', $request->device_id);
        }

        $logs = $query->latest()->paginate(10);
        $devices = Device::pluck('name', 'id');

        return view('maintenance-logs.index', compact('logs', 'devices'));
    }

    public function create()
    {
        $devices = Device::all();
        $tickets = Ticket::whereIn('status', ['open', 'in_progress'])->get();
        $spareParts = SparePart::where('quantity', '>', 0)->get();

        return view('maintenance-logs.create', compact('devices', 'tickets', 'spareParts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ticket_id' => 'nullable|exists:tickets,id',
            'device_id' => 'required|exists:devices,id',
            'maintenance_type' => 'required|in:preventive,corrective,emergency',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'performed_at' => 'required|date',
            'spare_parts' => 'nullable|array',
            'spare_parts.*.id' => 'exists:spare_parts,id',
            'spare_parts.*.quantity' => 'integer|min:1',
        ]);

        $data['user_id'] = Auth::id();

        $log = MaintenanceLog::create($data);

        if (!empty($request->spare_parts)) {
            $syncData = [];
            foreach ($request->spare_parts as $part) {
                $syncData[$part['id']] = ['quantity_used' => $part['quantity'] ?? 1];
                SparePart::find($part['id'])->decrement('quantity', $part['quantity'] ?? 1);
            }
            $log->spareParts()->attach($syncData);
        }

        return redirect()->route('maintenance-logs.index')->with('success', 'Log maintenance berhasil ditambahkan.');
    }

    public function show(MaintenanceLog $maintenanceLog)
    {
        $maintenanceLog->load(['device', 'user', 'ticket', 'spareParts']);
        return view('maintenance-logs.show', compact('maintenanceLog'));
    }

    public function edit(MaintenanceLog $maintenanceLog)
    {
        $devices = Device::all();
        $tickets = Ticket::whereIn('status', ['open', 'in_progress'])->get();
        $spareParts = SparePart::all();

        return view('maintenance-logs.edit', compact('maintenanceLog', 'devices', 'tickets', 'spareParts'));
    }

    public function update(Request $request, MaintenanceLog $maintenanceLog)
    {
        $data = $request->validate([
            'ticket_id' => 'nullable|exists:tickets,id',
            'device_id' => 'required|exists:devices,id',
            'maintenance_type' => 'required|in:preventive,corrective,emergency',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'performed_at' => 'required|date',
        ]);

        $maintenanceLog->update($data);

        return redirect()->route('maintenance-logs.index')->with('success', 'Log maintenance berhasil diperbarui.');
    }

    public function destroy(MaintenanceLog $maintenanceLog)
    {
        $maintenanceLog->delete();
        return redirect()->route('maintenance-logs.index')->with('success', 'Log maintenance berhasil dihapus.');
    }
}
