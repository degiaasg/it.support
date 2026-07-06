<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center no-print">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 14h12v8H6z"/></svg>
                    Print / PDF
                </button>
                <a href="{{ route('forms.pemeriksaan') }}" class="bg-gray-500 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-sm flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg" id="print-area">
                <div class="p-6 sm:p-8">
                    @php
                        $f = $data->form_data ?? [];
                        $hwItems = ['Processor', 'Mainboard', 'Monitor/LCD', 'Casing', 'Camera', 'Port USB/Charger', 'Connectivity (LAN/WIFI)', 'Adaptor/PSU', 'Trackpad/Keyboard/Mouse', 'Audio (Speaker/Microphone)', 'Memory', 'Disk', 'Graphics Card', 'Battery'];
                        $appItems = [
                            'Antivirus Kaspersky' => 'app_antivirus',
                            'Manage Engine Desktop Central' => 'app_manage_engine',
                            'Microsoft Office365' => 'app_office365',
                            'OneDrive' => 'app_onedrive',
                            'Microsoft Teams' => 'app_teams',
                            'Adobe Reader' => 'app_adobe_reader',
                            'Micro Edge' => 'app_micro_edge',
                            'Anydesk' => 'app_anydesk',
                            'Adobe Creative Photoshop' => 'app_adobe_creative',
                        ];
                        $signers = ['diperiksa' => 'Diperiksa Oleh', 'diketahui' => 'Diketahui Oleh', 'disetujui' => 'Disetujui Oleh'];
                    @endphp

                    {{-- Kop --}}
                    <div class="text-center mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">FORMULIR PEMERIKSAAN PERANGKAT</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kategori }} - {{ $kategoriLabel }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">No. Form: <strong class="text-gray-700 dark:text-gray-300">{{ $data->no_form }}</strong></p>
                    </div>

                    {{-- Informasi User --}}
                    <table class="doc-table mb-4">
                        <tr><td class="doc-label">Nama User</td><td class="px-1">:</td><td class="doc-value">{{ $f['nama_user'] ?? '-' }}</td>
                            <td class="doc-label">NIK User</td><td class="px-1">:</td><td class="doc-value">{{ $f['nik_user'] ?? '-' }}</td></tr>
                        <tr><td class="doc-label">Department</td><td>:</td><td>{{ $f['department'] ?? '-' }}</td>
                            <td class="doc-label">Site / B. Unit</td><td>:</td><td>{{ $f['site'] ?? '-' }}</td></tr>
                        <tr><td class="doc-label">No. Telepon</td><td>:</td><td>{{ $f['no_telepon'] ?? '-' }}</td>
                            <td class="doc-label">Alamat Email</td><td>:</td><td>{{ $f['email'] ?? '-' }}</td></tr>
                    </table>

                    {{-- Brand --}}
                    <table class="doc-table mb-4">
                        <tr>
                            <td class="doc-label w-1/6">KATEGORI</td>
                            <td class="doc-value font-semibold">{{ $kategoriLabel }}</td>
                            <td class="doc-label w-1/6">BRAND</td>
                            <td class="doc-value font-semibold">{{ $f['brand'] ?? ($f['tipe'] ?? '-') }}</td>
                        </tr>
                    </table>

                    @php
                        $hasHw = false;
                        foreach ($hwItems as $hi) { if (!empty($f['hw_'.Str::slug($hi, '_')])) { $hasHw = true; break; } }
                    @endphp
                    @if($hasHw || !empty($f['hw_lainnya']))
                    <h4 class="section-title">Pemeriksaan Hardware</h4>
                    <table class="doc-table mb-4">
                        <thead>
                            <tr class="border-b dark:border-gray-700 font-semibold text-xs">
                                <td class="py-1.5 px-2 w-1/2">Name</td>
                                <td class="py-1.5 px-2 text-center w-1/4">Kondisi</td>
                                <td class="py-1.5 px-2 w-1/4">Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hwItems as $item)
                            @php
                                $key = 'hw_' . Str::slug($item, '_');
                                $val = $f[$key] ?? '';
                                $ket = $f[$key . '_ket'] ?? '';
                            @endphp
                            <tr class="text-xs border-b dark:border-gray-700">
                                <td class="py-1 px-2">{{ $item }}</td>
                                <td class="py-1 px-2 text-center">{{ $val === 'BAIK' ? '✓' : ($val === 'TIDAK_BAIK' ? 'X' : '-') }}</td>
                                <td class="py-1 px-2">{{ $ket }}</td>
                            </tr>
                            @endforeach
                            @php
                                $hwLainNama = $f['hw_lainnya_nama'] ?? '';
                                $hwLainVal = $f['hw_lainnya'] ?? '';
                                $hwLainKet = $f['hw_lainnya_ket'] ?? '';
                            @endphp
                            @if($hwLainNama || $hwLainVal || $hwLainKet)
                            <tr class="text-xs border-b dark:border-gray-700">
                                <td class="py-1 px-2">{{ $hwLainNama ?: 'Others' }}</td>
                                <td class="py-1 px-2 text-center">{{ $hwLainVal === 'BAIK' ? '✓' : ($hwLainVal === 'TIDAK_BAIK' ? 'X' : '-') }}</td>
                                <td class="py-1 px-2">{{ $hwLainKet }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    @endif

                    @php
                        $hasApp = false;
                        foreach ($appItems as $ak) { if (!empty($f[$ak])) { $hasApp = true; break; } }
                    @endphp
                    @if($hasApp || !empty($f['app_lainnya']))
                    <h4 class="section-title">Pemeriksaan Aplikasi</h4>
                    <table class="doc-table mb-4">
                        <thead>
                            <tr class="border-b dark:border-gray-700 font-semibold text-xs">
                                <td class="py-1.5 px-2 w-1/2">Name</td>
                                <td class="py-1.5 px-2 text-center w-1/4">Kondisi</td>
                                <td class="py-1.5 px-2 w-1/4">Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appItems as $label => $key)
                            @php
                                $val = $f[$key] ?? '';
                                $ket = $f[$key . '_ket'] ?? '';
                            @endphp
                            <tr class="text-xs border-b dark:border-gray-700">
                                <td class="py-1 px-2">{{ $label }}</td>
                                <td class="py-1 px-2 text-center">{{ $val === 'BAIK' ? '✓' : ($val === 'TIDAK_BAIK' ? 'X' : '-') }}</td>
                                <td class="py-1 px-2">{{ $ket }}</td>
                            </tr>
                            @endforeach
                            @php
                                $appLainNama = $f['app_lainnya_nama'] ?? '';
                                $appLainVal = $f['app_lainnya'] ?? '';
                                $appLainKet = $f['app_lainnya_ket'] ?? '';
                            @endphp
                            @if($appLainNama || $appLainVal || $appLainKet)
                            <tr class="text-xs border-b dark:border-gray-700">
                                <td class="py-1 px-2">{{ $appLainNama ?: 'Others' }}</td>
                                <td class="py-1 px-2 text-center">{{ $appLainVal === 'BAIK' ? '✓' : ($appLainVal === 'TIDAK_BAIK' ? 'X' : '-') }}</td>
                                <td class="py-1 px-2">{{ $appLainKet }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    @endif

                    {{-- OS --}}
                    @if(!empty($f['os_name']) || !empty($f['os_kondisi']))
                    <table class="doc-table mb-4">
                        <tr><td class="doc-label w-1/6">Operating System</td>
                            <td>{{ $f['os_name'] ?? '-' }}</td>
                            <td class="doc-label w-1/6">Kondisi</td>
                            <td>{{ ($f['os_kondisi'] ?? '') === 'BAIK' ? '✓' : (($f['os_kondisi'] ?? '') === 'TIDAK_BAIK' ? 'X' : '-') }}</td></tr>
                    </table>
                    @endif

                    {{-- Tindakan --}}
                    @php
                        $tindakanFields = [
                            'tindakan_marking' => 'Marking',
                            'tindakan_install_repair_reset_os' => 'Install / Repair / Reset OS',
                            'tindakan_create_delete_account' => 'Create / Delete Account',
                            'tindakan_delete_backup_data' => 'Delete / Backup Data',
                            'tindakan_install_uninstall_app' => 'Install / Uninstall Application',
                            'tindakan_service_sparepart' => 'Service / Pergantian Sparepart',
                            'tindakan_pergantian_unit' => 'Pergantian Unit (Replacement Unit)',
                        ];
                        $checkedTindakan = [];
                        foreach ($tindakanFields as $tf => $tl) {
                            if (($f[$tf] ?? '') === '1') $checkedTindakan[] = $tl;
                        }
                    @endphp
                    @if(!empty($checkedTindakan) || !empty($f['tindakan_lain']))
                    <h4 class="section-title">Tindakan</h4>
                    <div class="text-xs mb-4">
                        @foreach($checkedTindakan as $ct)
                        <span class="inline-block mr-4">✓ {{ $ct }}</span>
                        @endforeach
                        @if(!empty($f['tindakan_lain']))
                        <span class="inline-block mr-4">✓ {{ $f['tindakan_lain'] }}</span>
                        @endif
                    </div>
                    @endif

                    {{-- Catatan & Hasil --}}
                    <h4 class="section-title">Hasil Pemeriksaan</h4>
                    <table class="doc-table mb-4">
                        <tr><td class="doc-label w-1/6">Tanggal</td><td>{{ \Carbon\Carbon::parse($data->tanggal_pemeriksaan)->format('d/m/Y') }}</td>
                            <td class="doc-label w-1/6">Pemeriksa</td><td>{{ $data->pemeriksa }}</td></tr>
                    </table>
                    @if($data->keterangan)
                    <div class="text-xs mb-2"><span class="font-semibold">Catatan :</span> {{ $data->keterangan }}</div>
                    @endif
                    <div class="text-xs mb-6"><span class="font-semibold">Hasil :</span> {{ $data->hasil_pemeriksaan ?: '-' }}</div>

                    {{-- Signature --}}
                    <div class="grid grid-cols-3 gap-4 text-xs">
                        @foreach($signers as $key => $label)
                        <div class="text-center">
                            <p class="font-semibold mb-1">{{ $label }}</p>
                            <div class="mb-1">
                                @php $sigPath = $f['esign_'.$key.'_signature'] ?? null; @endphp
                                @if($sigPath)
                                <img src="{{ asset($sigPath) }}" alt="Tanda Tangan" class="inline max-h-16 border dark:border-gray-700">
                                @endif
                            </div>
                            <p>{{ $f['esign_'.$key.'_nama'] ?? '-' }}</p>
                            <p class="text-gray-500 dark:text-gray-400">{{ isset($f['esign_'.$key.'_tanggal']) ? \Carbon\Carbon::parse($f['esign_'.$key.'_tanggal'])->format('d/m/Y') : '-' }}</p>
                        </div>
                        @endforeach
                    </div>

                    {{-- Dynamic data from other categories (DC, NETV, etc.) --}}
                    @php
                        $otherGroups = [
                            'dc_' => 'Pemeriksaan DC Infrastructure',
                            'net_' => 'Pemeriksaan Perangkat Jaringan',
                        ];
                        $sigKeys = ['esign_diperiksa_signature','esign_diketahui_signature','esign_disetujui_signature'];
                    @endphp
                    @foreach($otherGroups as $pfx => $gLabel)
                        @php
                            $items = [];
                            foreach ($f as $k => $v) {
                                if (in_array($k, $sigKeys)) continue;
                                if (str_starts_with($k, $pfx) && !str_contains($k, '_ket')) {
                                    $items[] = ['key' => $k, 'label' => Str::title(str_replace('_', ' ', substr($k, strlen($pfx)))), 'val' => $v, 'ket' => $f[$k.'_ket'] ?? ''];
                                }
                            }
                        @endphp
                        @if(!empty($items))
                        <h4 class="section-title">{{ $gLabel }}</h4>
                        <table class="doc-table mb-4">
                            <thead>
                                <tr class="border-b dark:border-gray-700 font-semibold text-xs">
                                    <td class="py-1.5 px-2 w-1/2">Komponen</td>
                                    <td class="py-1.5 px-2 text-center w-1/4">Kondisi</td>
                                    <td class="py-1.5 px-2 w-1/4">Keterangan</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $it)
                                <tr class="text-xs border-b dark:border-gray-700">
                                    <td class="py-1 px-2">{{ $it['label'] }}</td>
                                    <td class="py-1 px-2 text-center">{{ $it['val'] === 'BAIK' ? '✓' : ($it['val'] === 'TIDAK_BAIK' ? 'X' : ($it['val'] === '1' ? '✓' : '-' )) }}</td>
                                    <td class="py-1 px-2">{{ $it['ket'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    @endforeach

                    {{-- Uncategorized fields (MOBIL: imei, PERID: tipe_peripheral, STGDV: kapasitas, TELCD: nomor_telepon, etc.) --}}
                    @php
                        $shownKeys = ['nama_user','nik_user','department','site','no_telepon','email','brand','tipe','no_serial','no_asset','status_baru_lama','lokasi','ip_address','mac_address','firmware','os_name','os_kondisi','tindakan_lain','hw_lainnya_nama','hw_lainnya','hw_lainnya_ket','app_lainnya_nama','app_lainnya','app_lainnya_ket'];
                        $extraRows = [];
                        foreach ($f as $k => $v) {
                            if (in_array($k, $sigKeys) || str_ends_with($k, '_ket') || in_array($k, $shownKeys)) continue;
                            if (str_starts_with($k, 'hw_') || str_starts_with($k, 'app_') || str_starts_with($k, 'dc_') || str_starts_with($k, 'net_') || str_starts_with($k, 'tindakan_') || str_starts_with($k, 'os_') || str_starts_with($k, 'esign_')) continue;
                            $extraRows[$k] = $v;
                        }
                    @endphp
                    @if(!empty($extraRows))
                    <h4 class="section-title">Data Perangkat</h4>
                    <table class="doc-table mb-4">
                        @foreach($extraRows as $k => $v)
                        <tr class="text-xs">
                            <td class="py-1 px-2 font-semibold w-1/3">{{ Str::title(str_replace('_', ' ', $k)) }}</td>
                            <td class="py-1 px-2">{{ $v ?: '-' }}</td>
                        </tr>
                        @endforeach
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .doc-table { width: 100%; font-size: 0.75rem; border-collapse: collapse; }
        .doc-table td { padding: 0.25rem 0.5rem; vertical-align: top; }
        .doc-label { font-weight: 600; color: #374151; white-space: nowrap; }
        .dark .doc-label { color: #d1d5db; }
        .doc-value { color: #111827; }
        .dark .doc-value { color: #f3f4f6; }
        .section-title { font-size: 0.75rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem; padding-bottom: 0.25rem; border-bottom: 1px solid #d1d5db; }
        .dark .section-title { color: #e5e7eb; border-bottom-color: #4b5563; }

        @media print {
            @page { margin: 0.4in; size: A4 portrait; }
            body { background: white !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            header, nav, .no-print { display: none !important; }
            .shadow-sm, .shadow { box-shadow: none !important; }
            #print-area { box-shadow: none !important; border: none !important; max-width: 100% !important; }
            .sm\:rounded-lg { border-radius: 0 !important; }
            .max-w-5xl { max-width: 100% !important; }
            .py-12 { padding: 0 !important; }
            .p-6 { padding: 0 !important; }
            .doc-table td { padding: 0.15rem 0.4rem; }
            .text-xs { font-size: 8pt !important; }
            .text-sm { font-size: 9pt !important; }
            .text-lg { font-size: 12pt !important; }
            .section-title { font-size: 9pt !important; }
            img { max-height: 60px !important; }
            body, .text-gray-900, .text-gray-700 { color: #000 !important; }
            .text-gray-500, .text-gray-400 { color: #555 !important; }
            .dark\:text-gray-100, .dark\:text-gray-200, .dark\:text-gray-300, .dark\:text-gray-400, .dark\:text-gray-500 { color: #000 !important; }
            .doc-label { color: #333 !important; }
            .doc-value { color: #000 !important; }
        }
    </style>
</x-app-layout>
