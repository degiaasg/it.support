<?php

namespace App\Http\Controllers;

use App\Models\Device;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with('category')->latest()->paginate(10);
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        $categories = \App\Models\Category::pluck('name', 'id');
        return view('devices.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|unique:devices,serial_number',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date',
            'status' => 'required|in:available,in_use,under_maintenance,retired',
            'notes' => 'nullable|string',
        ]);

        Device::create($data);

        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil ditambahkan.');
    }

    public function show(Device $device)
    {
        $device->load('category', 'tickets', 'maintenanceLogs.user');
        return view('devices.show', compact('device'));
    }

    public function edit(Device $device)
    {
        $categories = \App\Models\Category::pluck('name', 'id');
        return view('devices.edit', compact('device', 'categories'));
    }

    public function update(Request $request, Device $device)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|unique:devices,serial_number,' . $device->id,
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date',
            'status' => 'required|in:available,in_use,under_maintenance,retired',
            'notes' => 'nullable|string',
        ]);

        $device->update($data);

        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil diperbarui.');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil dihapus.');
    }

    public function qrCode(Device $device)
    {
        $url = route('devices.show', $device);
        $qrCode = QrCode::format('png')
            ->size(300)
            ->errorCorrection('M')
            ->generate($url);

        return response($qrCode)->header('Content-Type', 'image/png');
    }
}
