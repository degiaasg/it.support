<?php

namespace App\Http\Controllers;

use App\Models\CompdLapt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CompdLaptController extends Controller
{
    public function index()
    {
        $assets = CompdLapt::orderBy('id_lapt')->paginate(15);
        return view('assets.compd-lapt.index', compact('assets'));
    }

    public function show(string $id)
    {
        $asset = CompdLapt::findOrFail($id);
        return view('assets.compd-lapt.show', compact('asset'));
    }

    public function create()
    {
        $last = CompdLapt::orderBy('id_lapt', 'desc')->first();
        $nextSeq = $last ? ((int) explode('-', $last->id_lapt)[1]) + 1 : 1;
        $nextId = 'COMPD.LAPT-' . str_pad($nextSeq, 4, '0', STR_PAD_LEFT);
        return view('assets.compd-lapt.create', compact('nextId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_lapt' => 'required|string|max:20|unique:compd_lapt,id_lapt',
            'hostname' => 'required|string|max:50',
            'sn' => 'required|string|max:50',
            'barcode' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
            'type' => 'required|string|max:100',
            'processors' => 'required|string|max:100',
            'gen' => 'required|integer',
            'ram_cap' => 'required|integer',
            'ram_slot' => 'required|string|max:20',
            'ram_type' => 'required|string|max:100',
            'disk1_cap' => 'required|integer',
            'disk1_type' => 'required|string|max:100',
            'disk2_cap' => 'nullable|integer',
            'disk2_type' => 'nullable|string|max:100',
            'os' => 'required|in:WINDOWS,MACHINTOS,LINUX',
            'os_type' => 'required|string|max:100',
            'os_ver' => 'required|string|max:20',
            'product_id' => 'required|string|max:50',
            'product_key' => 'required|string|max:50',
            'bh' => 'nullable|numeric|min:0|max:100',
            'dc' => 'nullable|integer',
            'fcc' => 'nullable|integer',
            'casing' => 'required|in:GOOD,BAD',
            'display' => 'required|in:GOOD,BAD',
            'port_display' => 'required|in:GOOD,BAD',
            'keyboard' => 'required|in:GOOD,BAD',
            'touchpad' => 'required|in:GOOD,BAD',
            'port_usb' => 'required|in:GOOD,BAD',
            'port_jeck' => 'required|in:GOOD,BAD',
            'port_psu' => 'required|in:GOOD,BAD',
            'fan' => 'required|in:GOOD,BAD',
            'webcam' => 'required|in:GOOD,BAD',
            'microfon' => 'required|in:GOOD,BAD',
            'speaker' => 'required|in:GOOD,BAD',
            'connection' => 'required|in:GOOD,BAD',
            'conditions' => 'required|in:GOOD,BAD',
            'sub_con' => 'required|in:GREAT,NORMAL,CAUTIONS,POOR',
            'note_con' => 'nullable|string',
            'solution' => 'required|in:KEEP,UPGRADE,REPAIR,REPLACE,DISPOSE',
            'note_sol' => 'nullable|string',
            'functions' => 'required|in:PERSONAL,GROUP,SYSTEM,OPERATIONAL',
            'note_func' => 'nullable|string',
            'history_pic' => 'nullable|string',
            'location' => 'required|string|max:100',
            'note_loc' => 'required|string|max:100',
            'status' => 'required|in:IN USE,IN STORE,IN REPAIR,DISPOSING,DISPOSED,INACTIVE',
            'pic_nip' => 'nullable|integer',
            'pic_name' => 'nullable|string|max:100',
            'total_maintenance_corr' => 'nullable|integer',
            'last_maintenance_corr' => 'nullable|date',
            'total_maintenance_prev' => 'nullable|integer',
            'last_maintenance_prev' => 'nullable|date',
            'total_maintenance_pred' => 'nullable|integer',
            'last_maintenance_pred' => 'nullable|date',
        ]);

        $data['id_asset_category'] = 'LAPT';
        $data['category'] = 'LAPTOP';

        CompdLapt::create($data);

        return redirect()->route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop'])
            ->with('success', 'Laptop berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $asset = CompdLapt::findOrFail($id);
        return view('assets.compd-lapt.edit', compact('asset'));
    }

    public function update(Request $request, string $id)
    {
        $asset = CompdLapt::findOrFail($id);

        $data = $request->validate([
            'hostname' => 'required|string|max:50',
            'sn' => 'required|string|max:50',
            'barcode' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
            'type' => 'required|string|max:100',
            'processors' => 'required|string|max:100',
            'gen' => 'required|integer',
            'ram_cap' => 'required|integer',
            'ram_slot' => 'required|string|max:20',
            'ram_type' => 'required|string|max:100',
            'disk1_cap' => 'required|integer',
            'disk1_type' => 'required|string|max:100',
            'disk2_cap' => 'nullable|integer',
            'disk2_type' => 'nullable|string|max:100',
            'os' => 'required|in:WINDOWS,MACHINTOS,LINUX',
            'os_type' => 'required|string|max:100',
            'os_ver' => 'required|string|max:20',
            'product_id' => 'required|string|max:50',
            'product_key' => 'required|string|max:50',
            'bh' => 'nullable|numeric|min:0|max:100',
            'dc' => 'nullable|integer',
            'fcc' => 'nullable|integer',
            'casing' => 'required|in:GOOD,BAD',
            'display' => 'required|in:GOOD,BAD',
            'port_display' => 'required|in:GOOD,BAD',
            'keyboard' => 'required|in:GOOD,BAD',
            'touchpad' => 'required|in:GOOD,BAD',
            'port_usb' => 'required|in:GOOD,BAD',
            'port_jeck' => 'required|in:GOOD,BAD',
            'port_psu' => 'required|in:GOOD,BAD',
            'fan' => 'required|in:GOOD,BAD',
            'webcam' => 'required|in:GOOD,BAD',
            'microfon' => 'required|in:GOOD,BAD',
            'speaker' => 'required|in:GOOD,BAD',
            'connection' => 'required|in:GOOD,BAD',
            'conditions' => 'required|in:GOOD,BAD',
            'sub_con' => 'required|in:GREAT,NORMAL,CAUTIONS,POOR',
            'note_con' => 'nullable|string',
            'solution' => 'required|in:KEEP,UPGRADE,REPAIR,REPLACE,DISPOSE',
            'note_sol' => 'nullable|string',
            'functions' => 'required|in:PERSONAL,GROUP,SYSTEM,OPERATIONAL',
            'note_func' => 'nullable|string',
            'history_pic' => 'nullable|string',
            'location' => 'required|string|max:100',
            'note_loc' => 'required|string|max:100',
            'status' => 'required|in:IN USE,IN STORE,IN REPAIR,DISPOSING,DISPOSED,INACTIVE',
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

        return redirect()->route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop'])
            ->with('success', 'Laptop berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $asset = CompdLapt::findOrFail($id);
        $asset->delete();

        return redirect()->route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop'])
            ->with('success', 'Laptop berhasil dihapus.');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');

        $headers = fgetcsv($handle);
        $headers = array_map('trim', $headers);

        $rowCount = 0;
        $columnFillCount = array_fill_keys($headers, 0);

        while (($line = fgetcsv($handle)) !== false) {
            $rowCount++;
            $line = array_map('trim', $line);
            foreach ($headers as $i => $header) {
                if (isset($line[$i]) && $line[$i] !== '') {
                    $columnFillCount[$header]++;
                }
            }
        }
        fclose($handle);

        $tempPath = $file->store('import-temp', 'local');

        $fillable = (new CompdLapt)->getFillable();
        $autoSet = ['id_asset_category', 'category'];

        $csvColumns = array_map(function ($h) use ($fillable, $autoSet, $columnFillCount) {
            return [
                'name' => $h,
                'recognized' => in_array($h, $fillable),
                'auto_set' => in_array($h, $autoSet),
                'filled' => $columnFillCount[$h] ?? 0,
            ];
        }, $headers);

        $requiredCols = [
            'id_lapt', 'hostname', 'sn', 'barcode', 'brand', 'type', 'processors', 'gen',
            'ram_cap', 'ram_slot', 'ram_type', 'disk1_cap', 'disk1_type',
            'os', 'os_type', 'os_ver', 'product_id', 'product_key',
            'casing', 'display', 'port_display', 'keyboard', 'touchpad', 'port_usb',
            'port_jeck', 'port_psu', 'fan', 'webcam', 'microfon', 'speaker', 'connection',
            'conditions', 'sub_con', 'solution', 'functions', 'location', 'note_loc', 'status',
        ];

        $missingRequired = array_values(array_diff($requiredCols, $headers));

        return view('assets.compd-lapt.import-preview', compact(
            'csvColumns', 'rowCount', 'tempPath', 'missingRequired', 'requiredCols'
        ));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:csv,txt|max:2048',
            'temp_path' => 'required_without:file|string',
        ]);

        if ($request->hasFile('file')) {
            $realPath = $request->file('file')->getRealPath();
        } else {
            $realPath = storage_path("app/{$request->temp_path}");
            if (!file_exists($realPath)) {
                Log::warning('File tidak ditemukan. Silakan upload ulang.', [
                    'temp_path' => $request->temp_path,
                    'real_path' => $realPath,
                    'user' => $request->user()?->nip ?? $request->user()?->email ?? 'unknown',
                ]);
                return redirect()->route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop'])
                    ->with('error', 'File tidak ditemukan. Silakan upload ulang.');
            }
        }

        $handle = fopen($realPath, 'r');
        $headers = fgetcsv($handle);
        $headers = array_map('trim', $headers);

        $imported = 0;
        $errors = [];

        while (($line = fgetcsv($handle)) !== false) {
            $data = array_combine($headers, array_map('trim', $line));

            try {
                $data['id_asset_category'] = 'LAPT';
                $data['category'] = 'LAPTOP';
                CompdLapt::create($data);
                $imported++;
            } catch (\Exception $e) {
                $id = $data['id_lapt'] ?? 'unknown';
                $errors[] = "Baris {$id}: {$e->getMessage()}";
                continue;
            }
        }

        fclose($handle);

        if (!$request->hasFile('file') && isset($realPath)) {
            @unlink($realPath);
        }

        $message = "{$imported} laptop berhasil diimpor.";
        if (!empty($errors)) {
            $message .= ' ' . count($errors) . ' baris gagal.';
            return redirect()->route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop'])
                ->with('warning', $message)
                ->with('import_errors', $errors);
        }

        return redirect()->route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop'])
            ->with('success', $message);
    }

    public function downloadExample()
    {
        $path = base_path('data/excel/compd_lapt_import_example.csv');

        if (!file_exists($path)) {
            return redirect()->route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop'])
                ->with('error', 'File contoh tidak ditemukan.');
        }

        return response()->download($path, 'compd_lapt_import_example.csv');
    }

    public function export()
    {
        $assets = CompdLapt::all();
        $filename = 'compd_lapt_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = [
            'id_lapt', 'hostname', 'sn', 'barcode', 'brand', 'type',
            'processors', 'gen', 'ram_cap', 'ram_slot', 'ram_type',
            'disk1_cap', 'disk1_type', 'disk2_cap', 'disk2_type',
            'os', 'os_type', 'os_ver', 'product_id', 'product_key',
            'bh', 'dc', 'fcc', 'casing', 'display', 'port_display',
            'keyboard', 'touchpad', 'port_usb', 'port_jeck', 'port_psu',
            'fan', 'webcam', 'microfon', 'speaker', 'connection',
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
