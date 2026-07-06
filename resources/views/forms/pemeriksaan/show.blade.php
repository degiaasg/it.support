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
                <div class="p-8">
                    <div class="text-center mb-8">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">FORMULIR PEMERIKSAAN PERANGKAT</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kategori }} - {{ $kategoriLabel }}</p>
                        <p class="text-xs text-gray-400 mt-1">No. Form: <strong>{{ $data->no_form }}</strong></p>
                    </div>

                    <table class="min-w-full text-sm mb-6">
                        <tr class="border-b">
                            <td class="py-2 px-3 font-medium text-gray-700 dark:text-gray-300 w-1/4">Nama Perangkat</td>
                            <td class="py-2 px-3 text-gray-900 dark:text-gray-100">{{ $data->device_name }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 px-3 font-medium text-gray-700 dark:text-gray-300">Kategori Asset</td>
                            <td class="py-2 px-3 text-gray-900 dark:text-gray-100">{{ $kategori }} - {{ $kategoriLabel }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 px-3 font-medium text-gray-700 dark:text-gray-300">Tanggal Pemeriksaan</td>
                            <td class="py-2 px-3 text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($data->tanggal_pemeriksaan)->format('d/m/Y') }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 px-3 font-medium text-gray-700 dark:text-gray-300">Pemeriksa</td>
                            <td class="py-2 px-3 text-gray-900 dark:text-gray-100">{{ $data->pemeriksa }}</td>
                        </tr>
                        @if($data->keterangan)
                        <tr class="border-b">
                            <td class="py-2 px-3 font-medium text-gray-700 dark:text-gray-300">Catatan</td>
                            <td class="py-2 px-3 text-gray-900 dark:text-gray-100">{{ $data->keterangan }}</td>
                        </tr>
                        @endif
                        <tr class="border-b">
                            <td class="py-2 px-3 font-medium text-gray-700 dark:text-gray-300">Hasil Pemeriksaan</td>
                            <td class="py-2 px-3 text-gray-900 dark:text-gray-100">{{ $data->hasil_pemeriksaan }}</td>
                        </tr>
                    </table>

                    @php
                        $formData = $data->form_data ?? [];
                        $signatureKeys = ['esign_diperiksa_signature', 'esign_diketahui_signature', 'esign_disetujui_signature'];
                        $skipKeys = array_merge($signatureKeys, ['_token', '_method']);
                    @endphp

                    @if(!empty($formData))
                        @php
                            $groupDefs = [
                                'Informasi Perangkat' => [],
                                'Pemeriksaan Hardware' => ['hw_'],
                                'Pemeriksaan Aplikasi'  => ['os_', 'app_'],
                                'Pemeriksaan DC'        => ['dc_'],
                                'Pemeriksaan Network'   => ['net_'],
                                'Tindakan'              => ['tindakan_'],
                            ];

                            $grouped = [];
                            foreach ($formData as $key => $value) {
                                if (in_array($key, $skipKeys)) continue;
                                $placed = false;
                                foreach ($groupDefs as $gName => $prefixes) {
                                    foreach ($prefixes as $pfx) {
                                        if (str_starts_with($key, $pfx)) {
                                            $grouped[$gName][$key] = $value;
                                            $placed = true;
                                            break 2;
                                        }
                                    }
                                }
                                if (!$placed) {
                                    $grouped['Informasi Perangkat'][$key] = $value;
                                }
                            }
                        @endphp

                        @foreach($grouped as $gLabel => $items)
                            <div class="mb-6">
                                <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">{{ $gLabel }}</h4>
                                <table class="min-w-full text-sm">
                                    @foreach($items as $key => $value)
                                    @php
                                        if (str_contains($key, '_ket')) continue;
                                        $clean = preg_replace('/^(hw_|app_|dc_|net_|tindakan_|os_)/', '', $key);
                                        $label = Str::title(str_replace(['_', '-'], ' ', $clean));
                                        $ketKey = $key . '_ket';
                                        $ketValue = $formData[$ketKey] ?? null;
                                    @endphp
                                    <tr class="border-b">
                                        <td class="py-1.5 px-3 text-gray-600 dark:text-gray-400 w-1/3">{{ $label }}</td>
                                        <td class="py-1.5 px-3 text-gray-900 dark:text-gray-100">{{ $value === '1' ? '✓' : ($value === '' ? '-' : $value) }}</td>
                                        @if($ketValue)
                                        <td class="py-1.5 px-3 text-gray-500 dark:text-gray-400 text-xs">{{ $ketValue }}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endforeach
                    @endif

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
                                <div class="space-y-2 text-sm">
                                    <p><span class="text-gray-500 dark:text-gray-400">Nama:</span> {{ $formData['esign_'.$key.'_nama'] ?? '-' }}</p>
                                    <p><span class="text-gray-500 dark:text-gray-400">Jabatan:</span> {{ $formData['esign_'.$key.'_jabatan'] ?? '-' }}</p>
                                    <p><span class="text-gray-500 dark:text-gray-400">Tanggal:</span>
                                        {{ isset($formData['esign_'.$key.'_tanggal']) ? \Carbon\Carbon::parse($formData['esign_'.$key.'_tanggal'])->format('d/m/Y') : '-' }}
                                    </p>
                                    @php
                                    $sigPath = $formData['esign_'.$key.'_signature'] ?? null;
                                    @endphp
                                    @if($sigPath)
                                    <div class="mt-2">
                                        <img src="{{ asset($sigPath) }}" alt="Tanda Tangan {{ $label }}" class="max-h-20 border border-gray-200 dark:border-gray-700 rounded">
                                    </div>
                                    @else
                                    <p class="text-gray-400 italic text-xs">(Tanda tangan tidak tersedia)</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body { background: white !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            header, nav, .bg-gray-800, .dark\:bg-gray-800, .dark\:bg-gray-900 { background: white !important; }
            .shadow-sm, .shadow { box-shadow: none !important; }
            #print-area { box-shadow: none !important; border: none !important; }
            .sm\:rounded-lg { border-radius: 0 !important; }
            .max-w-5xl { max-width: 100% !important; }
            .py-12 { padding: 0 !important; }
            .p-8 { padding: 0.5in !important; }
            .no-print { display: none !important; }
            .text-gray-900 { color: #000 !important; }
            .text-gray-700 { color: #333 !important; }
            .text-gray-500 { color: #666 !important; }
            .text-gray-400 { color: #999 !important; }
        }
    </style>
</x-app-layout>
