<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    public function index()
    {
        $parts = SparePart::latest()->paginate(10);
        return view('spare-parts.index', compact('parts'));
    }

    public function create()
    {
        return view('spare-parts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'part_number' => 'required|string|max:255|unique:spare_parts,part_number',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        SparePart::create($data);

        return redirect()->route('spare-parts.index')->with('success', 'Spare part berhasil ditambahkan.');
    }

    public function edit(SparePart $sparePart)
    {
        return view('spare-parts.edit', compact('sparePart'));
    }

    public function update(Request $request, SparePart $sparePart)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'part_number' => 'required|string|max:255|unique:spare_parts,part_number,' . $sparePart->id,
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $sparePart->update($data);

        return redirect()->route('spare-parts.index')->with('success', 'Spare part berhasil diperbarui.');
    }

    public function destroy(SparePart $sparePart)
    {
        $sparePart->delete();
        return redirect()->route('spare-parts.index')->with('success', 'Spare part berhasil dihapus.');
    }
}
