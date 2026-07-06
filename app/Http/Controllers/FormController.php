<?php

namespace App\Http\Controllers;

use App\Models\FormPemeriksaanPerangkat;
use App\Models\FormPerawatanPerangkat;
use App\Models\FormPeminjamanAsset;
use App\Models\FormPerpindahanAsset;
use App\Models\FormPengembalianAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function pemeriksaan()
    {
        $data = FormPemeriksaanPerangkat::latest()->paginate(10);
        $title = 'Form Pemeriksaan Perangkat';
        return view('forms.pemeriksaan.index', compact('data', 'title'));
    }

    public function pemeriksaanCreate()
    {
        $title = 'Tambah Form Pemeriksaan Perangkat';
        $kategoriList = config('kategori_asset.kategori_asset');
        return view('forms.pemeriksaan.create', compact('title', 'kategoriList'));
    }

    public function pemeriksaanCreateForm($kategori)
    {
        $kategoriList = config('kategori_asset.kategori_asset');

        if (!array_key_exists($kategori, $kategoriList)) {
            abort(404);
        }

        $title = 'Tambah Form Pemeriksaan Perangkat - ' . $kategoriList[$kategori];
        $kategoriLabel = $kategoriList[$kategori];

        return view('forms.pemeriksaan.form.' . strtolower($kategori), compact('title', 'kategori', 'kategoriLabel'));
    }

    public function pemeriksaanStore(Request $request)
    {
        $kategoriList = config('kategori_asset.kategori_asset');
        $kategori = $request->input('kategori_asset');

        if (!array_key_exists($kategori, $kategoriList)) {
            abort(400, 'Kategori tidak valid.');
        }

        $rules = [
            'kategori_asset' => 'required|string',
            'device_name' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'pemeriksa' => 'required|string|max:255',
            'hasil_pemeriksaan' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        $formData = $request->except([
            'kategori_asset', 'device_name', 'tanggal_pemeriksaan',
            'pemeriksa', 'hasil_pemeriksaan', 'keterangan', '_token',
        ]);

        $signatureKeys = ['esign_diperiksa_signature', 'esign_diketahui_signature', 'esign_disetujui_signature'];
        foreach ($signatureKeys as $sigKey) {
            if (!empty($formData[$sigKey]) && str_starts_with((string) $formData[$sigKey], 'data:image/png;base64,')) {
                $base64 = (string) $formData[$sigKey];
                $imageData = base64_decode(explode(',', $base64)[1] ?? '');
                if ($imageData !== false && strlen($imageData) > 0) {
                    $filename = $kategori . '_' . $sigKey . '_' . now()->format('YmdHis') . '_' . uniqid() . '.png';
                    $path = 'signatures/' . $filename;
                    Storage::disk('public')->put($path, $imageData);
                    $formData[$sigKey] = 'storage/' . $path;
                } else {
                    $formData[$sigKey] = null;
                }
            } else {
                $formData[$sigKey] = null;
            }
        }

        $latest = FormPemeriksaanPerangkat::where('kategori_asset', $kategori)
            ->whereDate('created_at', today())
            ->count();

        $noForm = sprintf(
            'FPP/%s/%s/%03d',
            $kategori,
            now()->format('dmy'),
            $latest + 1
        );

        FormPemeriksaanPerangkat::create([
            'no_form' => $noForm,
            'kategori_asset' => $kategori,
            'device_name' => $validated['device_name'],
            'tanggal_pemeriksaan' => $validated['tanggal_pemeriksaan'],
            'pemeriksa' => $validated['pemeriksa'],
            'hasil_pemeriksaan' => $validated['hasil_pemeriksaan'] ?? '',
            'keterangan' => $validated['keterangan'],
            'form_data' => $formData,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('forms.pemeriksaan')->with('success', 'Data berhasil ditambahkan.');
    }

    public function pemeriksaanEdit($id)
    {
        $data = FormPemeriksaanPerangkat::findOrFail($id);
        $kategoriList = config('kategori_asset.kategori_asset');
        $kategori = $data->kategori_asset;

        if (!array_key_exists($kategori, $kategoriList)) {
            abort(404);
        }

        $title = 'Edit Form Pemeriksaan Perangkat - ' . $kategoriList[$kategori];
        $kategoriLabel = $kategoriList[$kategori];

        session()->flashInput(array_merge(
            $data->form_data ?? [],
            [
                'device_name' => $data->device_name,
                'tanggal_pemeriksaan' => $data->tanggal_pemeriksaan,
                'pemeriksa' => $data->pemeriksa,
                'hasil_pemeriksaan' => $data->hasil_pemeriksaan,
                'keterangan' => $data->keterangan,
            ]
        ));

        return view('forms.pemeriksaan.form.' . strtolower($kategori), compact('title', 'kategori', 'kategoriLabel', 'data'));
    }

    public function pemeriksaanUpdate(Request $request, $id)
    {
        $record = FormPemeriksaanPerangkat::findOrFail($id);

        $kategoriList = config('kategori_asset.kategori_asset');
        $kategori = $record->kategori_asset;

        if (!array_key_exists($kategori, $kategoriList)) {
            abort(400, 'Kategori tidak valid.');
        }

        $rules = [
            'device_name' => 'required|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'pemeriksa' => 'required|string|max:255',
            'hasil_pemeriksaan' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        $formData = $request->except([
            'kategori_asset', 'device_name', 'tanggal_pemeriksaan',
            'pemeriksa', 'hasil_pemeriksaan', 'keterangan', '_token', '_method',
        ]);

        $signatureKeys = ['esign_diperiksa_signature', 'esign_diketahui_signature', 'esign_disetujui_signature'];
        foreach ($signatureKeys as $sigKey) {
            if (!empty($formData[$sigKey]) && str_starts_with((string) $formData[$sigKey], 'data:image/png;base64,')) {
                $base64 = (string) $formData[$sigKey];
                $imageData = base64_decode(explode(',', $base64)[1] ?? '');
                if ($imageData !== false && strlen($imageData) > 0) {
                    $filename = $kategori . '_' . $sigKey . '_' . now()->format('YmdHis') . '_' . uniqid() . '.png';
                    $path = 'signatures/' . $filename;
                    Storage::disk('public')->put($path, $imageData);
                    $formData[$sigKey] = 'storage/' . $path;
                } else {
                    $formData[$sigKey] = null;
                }
            } else {
                unset($formData[$sigKey]);
            }
        }

        $record->update([
            'device_name' => $validated['device_name'],
            'tanggal_pemeriksaan' => $validated['tanggal_pemeriksaan'],
            'pemeriksa' => $validated['pemeriksa'],
            'hasil_pemeriksaan' => $validated['hasil_pemeriksaan'] ?? '',
            'keterangan' => $validated['keterangan'],
            'form_data' => $formData,
        ]);

        return redirect()->route('forms.pemeriksaan')->with('success', 'Data berhasil diperbarui.');
    }

    public function pemeriksaanDestroy($id)
    {
        $record = FormPemeriksaanPerangkat::findOrFail($id);

        $signatureKeys = ['esign_diperiksa_signature', 'esign_diketahui_signature', 'esign_disetujui_signature'];
        foreach ($signatureKeys as $sigKey) {
            $sigPath = $record->form_data[$sigKey] ?? null;
            if ($sigPath && str_starts_with((string) $sigPath, 'storage/')) {
                $relative = str_replace('storage/', '', (string) $sigPath);
                Storage::disk('public')->delete($relative);
            }
        }

        $record->delete();

        return redirect()->route('forms.pemeriksaan')->with('success', 'Data berhasil dihapus.');
    }

    public function perawatan()
    {
        $data = FormPerawatanPerangkat::latest()->paginate(10);
        $title = 'Form Perawatan Perangkat';
        return view('forms.perawatan.index', compact('data', 'title'));
    }

    public function peminjaman()
    {
        $data = FormPeminjamanAsset::latest()->paginate(10);
        $title = 'Form Peminjaman Asset';
        return view('forms.peminjaman.index', compact('data', 'title'));
    }

    public function perpindahan()
    {
        $data = FormPerpindahanAsset::latest()->paginate(10);
        $title = 'Form Perpindahan Asset';
        return view('forms.perpindahan.index', compact('data', 'title'));
    }

    public function pengembalian()
    {
        $data = FormPengembalianAsset::latest()->paginate(10);
        $title = 'Form Pengembalian Asset';
        return view('forms.pengembalian.index', compact('data', 'title'));
    }
}
