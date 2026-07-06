@php
$title = 'Tambah Laptop';
$action = route('assets.compd-lapt.store');
$method = 'POST';
$submitText = 'Simpan';
$asset = null;
@endphp

@include('assets.compd-lapt.form')
