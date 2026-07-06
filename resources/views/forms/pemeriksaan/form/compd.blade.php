<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
            <a href="{{ route('forms.pemeriksaan.create') }}" class="bg-gray-500 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('forms.pemeriksaan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kategori_asset" value="{{ $kategori }}">

                        <div class="text-center mb-8">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">FORMULIR PEMERIKSAAN PERANGKAT</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kategori }} - {{ $kategoriLabel }}</p>
                        </div>

                        {{-- Informasi Pengguna --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Informasi Pengguna</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama User</label>
                                    <input type="text" name="nama_user" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('nama_user') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIK User</label>
                                    <input type="text" name="nik_user" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('nik_user') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Department</label>
                                    <input type="text" name="department" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('department') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Site / B. Unit</label>
                                    <input type="text" name="site" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('site') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
                                    <input type="text" name="no_telepon" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('no_telepon') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat Email</label>
                                    <input type="email" name="email" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Perangkat --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Informasi Perangkat</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Brand</label>
                                    <input type="text" name="brand" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('brand') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe</label>
                                    <input type="text" name="tipe" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('tipe') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Perangkat</label>
                                    <input type="text" name="device_name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('device_name') }}" required>
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
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                    <select name="status_baru_lama" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">
                                        <option value="">-- Pilih --</option>
                                        <option value="BARU" {{ old('status_baru_lama') === 'BARU' ? 'selected' : '' }}>BARU</option>
                                        <option value="LAMA" {{ old('status_baru_lama') === 'LAMA' ? 'selected' : '' }}>LAMA</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Pemeriksaan Hardware --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Pemeriksaan Hardware</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="text-left py-2 px-3 w-1/2">Komponen</th>
                                            <th class="text-center py-2 px-3">Kondisi (✓ = Baik / X = Tidak Baik)</th>
                                            <th class="text-left py-2 px-3">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $hardwareItems = ['Processor', 'Mainboard', 'Monitor/LCD', 'Casing', 'Camera', 'Port USB/Charger', 'Connectivity (LAN/WIFI)', 'Adaptor/PSU', 'Trackpad/Keyboard/Mouse', 'Audio (Speaker/Microphone)', 'Memory', 'Disk', 'Graphics Card', 'Battery'];
                                        @endphp
                                        @foreach($hardwareItems as $item)
                                        <tr class="border-b">
                                            <td class="py-2 px-3">{{ $item }}</td>
                                            <td class="py-2 px-3 text-center">
                                                <select name="hw_{{ Str::slug($item, '_') }}" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs">
                                                    <option value="">--</option>
                                                    <option value="BAIK">✓ Baik</option>
                                                    <option value="TIDAK_BAIK">X Tidak Baik</option>
                                                </select>
                                            </td>
                                            <td class="py-2 px-3">
                                                <input type="text" name="hw_{{ Str::slug($item, '_') }}_ket" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="border-b">
                                            <td class="py-2 px-3">
                                                <input type="text" name="hw_lainnya_nama" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Lainnya...">
                                            </td>
                                            <td class="py-2 px-3 text-center">
                                                <select name="hw_lainnya" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs">
                                                    <option value="">--</option>
                                                    <option value="BAIK">✓ Baik</option>
                                                    <option value="TIDAK_BAIK">X Tidak Baik</option>
                                                </select>
                                            </td>
                                            <td class="py-2 px-3">
                                                <input type="text" name="hw_lainnya_ket" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pemeriksaan Aplikasi --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Pemeriksaan Aplikasi</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Operating System</label>
                                    <input type="text" name="os_name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" placeholder="Nama OS" value="{{ old('os_name') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">&nbsp;</label>
                                    <select name="os_kondisi" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">
                                        <option value="">-- Kondisi OS --</option>
                                        <option value="BAIK">✓ Baik</option>
                                        <option value="TIDAK_BAIK">X Tidak Baik</option>
                                    </select>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="text-left py-2 px-3 w-1/2">Aplikasi</th>
                                            <th class="text-center py-2 px-3">Kondisi</th>
                                            <th class="text-left py-2 px-3">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $appItems = [
                                            'Nama Perangkat' => 'nama_perangkat',
                                            'User Account Profile' => 'user_account_profile',
                                            'Disk Capacity Usage' => 'disk_capacity_usage',
                                            'Kinerja Sistem' => 'kinerja_sistem',
                                            'Antivirus Kaspersky' => 'antivirus',
                                            'Manage Engine Desktop Central' => 'manage_engine',
                                            'Microsoft Office365' => 'office365',
                                            'OneDrive' => 'onedrive',
                                            'Microsoft Teams' => 'teams',
                                            'Adobe Reader' => 'adobe_reader',
                                            'Micro Edge' => 'micro_edge',
                                            'Anydesk' => 'anydesk',
                                            'Adobe Creative Photoshop' => 'adobe_creative',
                                        ];
                                        @endphp
                                        @foreach($appItems as $label => $field)
                                        <tr class="border-b">
                                            <td class="py-2 px-3">{{ $label }}</td>
                                            <td class="py-2 px-3 text-center">
                                                <select name="app_{{ $field }}" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs">
                                                    <option value="">--</option>
                                                    <option value="BAIK">✓ Baik</option>
                                                    <option value="TIDAK_BAIK">X Tidak Baik</option>
                                                </select>
                                            </td>
                                            <td class="py-2 px-3">
                                                <input type="text" name="app_{{ $field }}_ket" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="border-b">
                                            <td class="py-2 px-3">
                                                <input type="text" name="app_lainnya_nama" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Lainnya...">
                                            </td>
                                            <td class="py-2 px-3 text-center">
                                                <select name="app_lainnya" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs">
                                                    <option value="">--</option>
                                                    <option value="BAIK">✓ Baik</option>
                                                    <option value="TIDAK_BAIK">X Tidak Baik</option>
                                                </select>
                                            </td>
                                            <td class="py-2 px-3">
                                                <input type="text" name="app_lainnya_ket" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Tindakan --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Tindakan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @php
                                $tindakanItems = [
                                    'marking' => 'Marking',
                                    'install_repair_reset_os' => 'Install / Repair / Reset OS',
                                    'create_delete_account' => 'Create / Delete Account',
                                    'delete_backup_data' => 'Delete / Backup Data',
                                    'install_uninstall_app' => 'Install / Uninstall Application',
                                    'service_sparepart' => 'Service / Pergantian Sparepart',
                                    'pergantian_unit' => 'Pergantian Unit (Replacement Unit)',
                                ];
                                @endphp
                                @foreach($tindakanItems as $field => $label)
                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                    <input type="checkbox" name="tindakan_{{ $field }}" value="1" {{ old('tindakan_'.$field) ? 'checked' : '' }} class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                                    {{ $label }}
                                </label>
                                @endforeach
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tindakan Lain</label>
                                <input type="text" name="tindakan_lain" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('tindakan_lain') }}">
                            </div>
                        </div>

                        {{-- Catatan & Hasil --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Hasil Pemeriksaan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Pemeriksaan</label>
                                    <input type="date" name="tanggal_pemeriksaan" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('tanggal_pemeriksaan', date('Y-m-d')) }}" required>
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
                                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 text-center">Diperiksa Oleh</p>
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Nama</label>
                                            <input type="text" name="esign_diperiksa_nama" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_diperiksa_nama') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Jabatan</label>
                                            <input type="text" name="esign_diperiksa_jabatan" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_diperiksa_jabatan') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tanggal</label>
                                            <input type="date" name="esign_diperiksa_tanggal" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_diperiksa_tanggal', date('Y-m-d')) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 text-center">Diketahui Oleh</p>
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Nama</label>
                                            <input type="text" name="esign_diketahui_nama" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_diketahui_nama') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Jabatan</label>
                                            <input type="text" name="esign_diketahui_jabatan" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_diketahui_jabatan') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tanggal</label>
                                            <input type="date" name="esign_diketahui_tanggal" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_diketahui_tanggal', date('Y-m-d')) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 text-center">Disetujui Oleh</p>
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Nama</label>
                                            <input type="text" name="esign_disetujui_nama" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_disetujui_nama') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Jabatan</label>
                                            <input type="text" name="esign_disetujui_jabatan" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_disetujui_jabatan') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tanggal</label>
                                            <input type="date" name="esign_disetujui_tanggal" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_disetujui_tanggal', date('Y-m-d')) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('forms.pemeriksaan.create') }}" class="px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">Batal</a>
                            <button type="submit" class="px-6 py-2 text-sm rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 font-medium">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
