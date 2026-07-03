<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'device', 'assignedTo']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if (Auth::user()->role === 'user') {
            $query->where('user_id', Auth::id());
        }

        $tickets = $query->latest()->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $user = Auth::user();
        $devices = Device::whereIn('status', ['available', 'in_use', 'under_maintenance'])->get();

        if ($user->role === 'admin' || $user->role === 'technician') {
            $users = User::where('role', 'user')->pluck('name', 'id');
        } else {
            $users = collect();
        }

        $technicians = User::whereIn('role', ['admin', 'technician'])->pluck('name', 'id');

        return view('tickets.create', compact('devices', 'users', 'technicians'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        if (Auth::user()->role === 'user') {
            $data['user_id'] = Auth::id();
        } else {
            $data['user_id'] = $request->user_id ?? Auth::id();
        }

        $data['status'] = 'open';

        Ticket::create($data);

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibuat.');
    }

    public function show(Ticket $ticket)
    {
        if (Auth::user()->role === 'user' && $ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $ticket->load(['user', 'device.category', 'assignedTo', 'maintenanceLogs.user']);
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $devices = Device::whereIn('status', ['available', 'in_use', 'under_maintenance'])->get();
        $technicians = User::whereIn('role', ['admin', 'technician'])->pluck('name', 'id');
        return view('tickets.edit', compact('ticket', 'devices', 'technicians'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,in_progress,resolved,closed',
            'priority' => 'required|in:low,medium,high,urgent',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        if (Auth::user()->role !== 'user') {
            $data['assigned_to'] = $request->assigned_to;
        }

        $ticket->update($data);

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate(['assigned_to' => 'required|exists:users,id']);

        $ticket->update([
            'assigned_to' => $request->assigned_to,
            'status' => 'in_progress',
        ]);

        return back()->with('success', 'Tiket berhasil ditugaskan.');
    }

    public function resolve(Ticket $ticket)
    {
        $ticket->update(['status' => 'resolved']);
        return back()->with('success', 'Tiket ditandai selesai.');
    }

    public function close(Ticket $ticket)
    {
        $ticket->update(['status' => 'closed']);
        return back()->with('success', 'Tiket ditutup.');
    }
}
