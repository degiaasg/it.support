<?php

namespace App\Http\Controllers;

use App\Models\PeridMous;
use Illuminate\Http\Request;

class PeridMousController extends Controller
{
    public function index()
    {
        $assets = PeridMous::orderBy('id_mous')->paginate(15);
        return view('assets.perid-mous.index', compact('assets'));
    }

    public function show(string $id)
    {
        $asset = PeridMous::findOrFail($id);
        return view('assets.perid-mous.show', compact('asset'));
    }

    public function create()
    {
        $last = PeridMous::orderBy('id_mous', 'desc')->first();
        $nextSeq = $last ? ((int) explode('-', $last->id_mous)[1]) + 1 : 1;
        $nextId = 'PERID.MOUS-' . str_pad($nextSeq, 4, '0', STR_PAD_LEFT);
        return view('assets.perid-mous.create', compact('nextId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_mous' => 'required|string|max:20|unique:perid_mous,id_mous',
            'hostname' => 'required|string|max:50',
            'sn' => 'required|string|max:50',
            'barcode' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
            'type' => 'required|string|max:100',
            'casing' => 'required|in:GOOD,BAD',
            'connection' => 'required|in:Wireless USB,Bluetooth,Wire',
            'conditions' => 'required|in:GOOD,BAD',
            'sub_con' => 'required|in:GREAT,NORMAL,COUTIONS,POOR',
            'note_con' => 'nullable|string',
            'solution' => 'required|in:KEEP,UPGRADE,REPAIR,REPLACE,DISPOSE',
            'note_sol' => 'nullable|string',
            'functions' => 'required|in:PERUSED,GROUP,SYSTEM,OPERATIONAL',
            'note_func' => 'nullable|string',
            'history_pic' => 'nullable|string',
            'location' => 'required|string|max:100',
            'note_loc' => 'required|string|max:100',
            'status' => 'required|in:IN USE,IN STORE,IN REPAIR,DISPOSING,DISPOSED,IN ACTIVE',
            'pic_nip' => 'nullable|integer',
            'pic_name' => 'nullable|string|max:100',
            'total_maintenance_corr' => 'nullable|integer',
            'last_maintenance_corr' => 'nullable|date',
            'total_maintenance_prev' => 'nullable|integer',
            'last_maintenance_prev' => 'nullable|date',
            'total_maintenance_pred' => 'nullable|integer',
            'last_maintenance_pred' => 'nullable|date',
        ]);

        $data['id_asset_category'] = 'MOUS';
        $data['category'] = 'MOUSE';

        PeridMous::create($data);

        return redirect()->route('assets.item', ['slug' => 'peripheral-devices', 'item' => 'mouse'])
            ->with('success', 'Mouse berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $asset = PeridMous::findOrFail($id);
        return view('assets.perid-mous.edit', compact('asset'));
    }

    public function update(Request $request, string $id)
    {
        $asset = PeridMous::findOrFail($id);

        $data = $request->validate([
            'hostname' => 'required|string|max:50',
            'sn' => 'required|string|max:50',
            'barcode' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
            'type' => 'required|string|max:100',
            'casing' => 'required|in:GOOD,BAD',
            'connection' => 'required|in:Wireless USB,Bluetooth,Wire',
            'conditions' => 'required|in:GOOD,BAD',
            'sub_con' => 'required|in:GREAT,NORMAL,COUTIONS,POOR',
            'note_con' => 'nullable|string',
            'solution' => 'required|in:KEEP,UPGRADE,REPAIR,REPLACE,DISPOSE',
            'note_sol' => 'nullable|string',
            'functions' => 'required|in:PERUSED,GROUP,SYSTEM,OPERATIONAL',
            'note_func' => 'nullable|string',
            'history_pic' => 'nullable|string',
            'location' => 'required|string|max:100',
            'note_loc' => 'required|string|max:100',
            'status' => 'required|in:IN USE,IN STORE,IN REPAIR,DISPOSING,DISPOSED,IN ACTIVE',
            'pic_nip' => 'nullable|integer',
            'pic_name' => 'nullable|string|max:100',
            'total_maintenance_corr' => 'nullable|integer',
            'last_maintenance_corr' => 'nullable|date',
            'total_maintenance_prev' => 'nullable|integer',
            'last_maintenance_prev' => 'nullable|date',
            'total_maintenance_pred' => 'nullable|integer',
            'last_maintenance_pred' => 'nullable|date',
        ]);

        $asset->update($data);

        return redirect()->route('assets.item', ['slug' => 'peripheral-devices', 'item' => 'mouse'])
            ->with('success', 'Mouse berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $asset = PeridMous::findOrFail($id);
        $asset->delete();

        return redirect()->route('assets.item', ['slug' => 'peripheral-devices', 'item' => 'mouse'])
            ->with('success', 'Mouse berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        $headers = fgetcsv($handle);
        $headers = array_map('trim', $headers);

        $imported = 0;
        $row = 1;

        while (($line = fgetcsv($handle)) !== false) {
            $row++;
            $data = array_combine($headers, array_map('trim', $line));

            try {
                $data['id_asset_category'] = 'MOUS';
                $data['category'] = 'MOUSE';
                PeridMous::create($data);
                $imported++;
            } catch (\Exception $e) {
                continue;
            }
        }

        fclose($handle);

        return redirect()->route('assets.item', ['slug' => 'peripheral-devices', 'item' => 'mouse'])
            ->with('success', "{$imported} mouse berhasil diimpor.");
    }

    public function export()
    {
        $assets = PeridMous::all();
        $filename = 'perid_mous_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = [
            'id_mous', 'hostname', 'sn', 'barcode', 'brand', 'type',
            'casing', 'connection',
            'conditions', 'sub_con', 'note_con', 'solution', 'note_sol',
            'functions', 'note_func', 'history_pic', 'location', 'note_loc',
            'status', 'pic_nip', 'pic_name',
            'total_maintenance_corr', 'last_maintenance_corr',
            'total_maintenance_prev', 'last_maintenance_prev',
            'total_maintenance_pred', 'last_maintenance_pred',
        ];

        $callback = function () use ($assets, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($assets as $asset) {
                $row = [];
                foreach ($columns as $col) {
                    $row[] = $asset->{$col};
                }
                fputcsv($handle, $row);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
