<?php

namespace App\Http\Controllers;

use App\Models\FormPemeriksaanPerangkat;
use App\Models\FormPerawatanPerangkat;
use App\Models\FormPeminjamanAsset;
use App\Models\FormPerpindahanAsset;
use App\Models\FormPengembalianAsset;

class FormController extends Controller
{
    public function pemeriksaan()
    {
        $data = FormPemeriksaanPerangkat::latest()->paginate(10);
        $title = 'Form Pemeriksaan Perangkat';
        return view('forms.pemeriksaan.index', compact('data', 'title'));
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
