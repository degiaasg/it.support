@php
$title = 'Edit Mouse - ' . $asset->id_mous;
$action = route('assets.perid-mous.update', $asset->id_mous);
$method = 'PUT';
$submitText = 'Perbarui';
@endphp

@include('assets.perid-mous.form')
