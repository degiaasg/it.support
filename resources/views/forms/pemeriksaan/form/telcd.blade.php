<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
            <a href="{{ route('forms.pemeriksaan') }}" class="bg-gray-500 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ isset($data) ? route('forms.pemeriksaan.update', $data->id) : route('forms.pemeriksaan.store') }}" method="POST">
                        @csrf
                        @isset($data) @method('PUT') @endisset
                        <input type="hidden" name="kategori_asset" value="{{ $kategori }}">

                        <div class="text-center mb-8">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">FORMULIR PEMERIKSAAN PERANGKAT</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kategori }} - {{ $kategoriLabel }}</p>
                        </div>

                        {{-- Informasi Perangkat --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Informasi Perangkat</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Perangkat</label>
                                    <input type="text" name="device_name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('device_name') }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Brand</label>
                                    <input type="text" name="brand" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('brand') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe/Model</label>
                                    <input type="text" name="tipe" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('tipe') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Serial</label>
                                    <input type="text" name="no_serial" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('no_serial') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Asset</label>
                                    <input type="text" name="no_asset" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('no_asset') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Extension / No. Telepon</label>
                                    <input type="text" name="nomor_telepon" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('nomor_telepon') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Pemeriksaan Telekomunikasi --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Pemeriksaan Perangkat Telekomunikasi</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="text-left py-2 px-3">Komponen</th>
                                            <th class="text-center py-2 px-3">Kondisi</th>
                                            <th class="text-left py-2 px-3">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $items = ['Physical Condition', 'Power Supply', 'Cable Connection', 'Handset', 'Display/LED', 'Keypad/Button', 'Ringtone/Speaker', 'Network Registration'];
                                        @endphp
                                        @foreach($items as $item)
                                        <tr class="border-b">
                                            <td class="py-2 px-3">{{ $item }}</td>
                                            <td class="py-2 px-3 text-center">
                                                <select name="tel_{{ Str::slug($item, '_') }}" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs">
                                                    <option value="">--</option>
                                                    <option value="BAIK">✓ Baik</option>
                                                    <option value="TIDAK_BAIK">X Tidak Baik</option>
                                                </select>
                                            </td>
                                            <td class="py-2 px-3">
                                                <input type="text" name="tel_{{ Str::slug($item, '_') }}_ket" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Hasil --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Hasil Pemeriksaan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Pemeriksaan</label>
                                    <input type="date" name="tanggal_pemeriksaan" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('tanggal_pemeriksaan', isset($data) ? $data->tanggal_pemeriksaan : date('Y-m-d')) }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pemeriksa</label>
                                    <input type="text" name="pemeriksa" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('pemeriksa', auth()->user()->name) }}" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan</label>
                                <textarea name="keterangan" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">{{ old('keterangan') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hasil Pemeriksaan</label>
                                <textarea name="hasil_pemeriksaan" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" placeholder="Kesimpulan hasil pemeriksaan...">{{ old('hasil_pemeriksaan') }}</textarea>
                            </div>
                        </div>

                        {{-- E-Sign --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">E-Sign</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @php
                                    $signers = [
                                        'diperiksa' => 'Diperiksa Oleh',
                                        'diketahui' => 'Diketahui Oleh',
                                        'disetujui' => 'Disetujui Oleh',
                                    ];
                                @endphp
                                @foreach($signers as $key => $label)
                                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 text-center">{{ $label }}</p>
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Nama</label>
                                            <input type="text" name="esign_{{ $key }}_nama" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_'.$key.'_nama') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Jabatan</label>
                                            <input type="text" name="esign_{{ $key }}_jabatan" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_'.$key.'_jabatan') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tanggal</label>
                                            <input type="date" name="esign_{{ $key }}_tanggal" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_'.$key.'_tanggal', date('Y-m-d')) }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tanda Tangan</label>
                                            <div class="signature-pad relative border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden" style="touch-action: none;">
                                                <canvas class="sig-canvas w-full" height="120" style="cursor: crosshair; display: block; touch-action: none; background: #fff;"></canvas>
                                                <div class="absolute bottom-1 right-1 flex gap-1">
                                                    <button type="button" class="sig-upload-btn text-xs px-2 py-0.5 rounded bg-blue-100 hover:bg-blue-200 text-blue-700" data-key="{{ $key }}" title="Upload PNG">📁</button>
                                                    <button type="button" class="sig-clear-btn text-xs px-2 py-0.5 rounded bg-gray-200 hover:bg-gray-300 text-gray-600" data-key="{{ $key }}" title="Hapus">🗑</button>
                                                </div>
                                                <input type="file" accept="image/png" class="sig-file-input hidden" data-key="{{ $key }}">
                                                <input type="hidden" name="esign_{{ $key }}_signature" class="sig-hidden" data-key="{{ $key }}" value="{{ old('esign_'.$key.'_signature') ? asset(old('esign_'.$key.'_signature')) : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('forms.pemeriksaan') }}" class="px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">Batal</a>
                            <button type="submit" class="px-6 py-2 text-sm rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 font-medium">{{ isset($data) ? 'Perbarui' : 'Simpan' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
