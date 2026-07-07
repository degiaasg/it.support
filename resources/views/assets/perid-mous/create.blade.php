@php
$title = 'Tambah Mouse';
$action = route('assets.perid-mous.store');
$method = 'POST';
$submitText = 'Simpan';
$asset = null;
@endphp

@include('assets.perid-mous.form')
