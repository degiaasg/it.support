@php
$title = 'Edit Laptop - ' . $asset->id_lapt;
$action = route('assets.compd-lapt.update', $asset->id_lapt);
$method = 'PUT';
$submitText = 'Perbarui';
@endphp

@include('assets.compd-lapt.form')
