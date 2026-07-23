<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop']) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Detail Laptop</h2>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('assets.compd-lapt.edit', $asset->id_lapt) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">
                    Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    {{-- Informasi Perangkat --}}
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Informasi Perangkat</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">ID Asset</span><p class="font-mono text-sm">{{ $asset->id_lapt }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Hostname</span><p class="font-mono text-sm">{{ $asset->hostname }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Serial Number</span><p class="font-mono text-sm">{{ $asset->sn }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Barcode</span><p class="font-mono text-sm">{{ $asset->barcode }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Brand</span><p class="text-sm">{{ $asset->brand }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Type</span><p class="text-sm">{{ $asset->type }}</p></div>
                    </div>

                    {{-- Spesifikasi --}}
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Spesifikasi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Processor</span><p class="text-sm">{{ $asset->processors }} (Gen {{ $asset->gen }})</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">RAM</span><p class="text-sm">{{ $asset->ram_cap }} GB ({{ $asset->ram_slot }}, {{ $asset->ram_type }})</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Disk 1</span><p class="text-sm">{{ $asset->disk1_cap }} GB ({{ $asset->disk1_type }})</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Disk 2</span><p class="text-sm">{{ $asset->disk2_cap ? $asset->disk2_cap . ' GB (' . $asset->disk2_type . ')' : '-' }}</p></div>
                    </div>

                    {{-- OS --}}
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Sistem Operasi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">OS</span><p class="text-sm">{{ $asset->os }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Tipe OS</span><p class="text-sm">{{ $asset->os_type }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Versi OS</span><p class="text-sm">{{ $asset->os_ver }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Product ID</span><p class="font-mono text-sm">{{ $asset->product_id }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Product Key</span><p class="font-mono text-sm">{{ $asset->product_key }}</p></div>
                    </div>

                    {{-- Baterai & Adaptor --}}
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Baterai & Adaptor</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Battery Health (%)</span><p class="text-sm">{{ $asset->bh ?? '-' }} %</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">DC</span><p class="text-sm">{{ $asset->dc ?? '-' }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">FCC</span><p class="text-sm">{{ $asset->fcc ?? '-' }}</p></div>
                    </div>

                    {{-- Kondisi Hardware --}}
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Kondisi Hardware</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-6">
                        @php
                        $hwItems = [
                            'Casing' => $asset->casing, 'Display' => $asset->display, 'Port Display' => $asset->port_display,
                            'Keyboard' => $asset->keyboard, 'Touchpad' => $asset->touchpad, 'Port USB' => $asset->port_usb,
                            'Port Jeck' => $asset->port_jeck, 'Port PSU' => $asset->port_psu, 'Fan' => $asset->fan,
                            'Webcam' => $asset->webcam, 'Microfon' => $asset->microfon, 'Speaker' => $asset->speaker,
                            'Connection' => $asset->connection,
                        ];
                        @endphp
                        @foreach($hwItems as $label => $val)
                        <div class="p-2 rounded {{ $val === 'GOOD' ? 'bg-green-50 dark:bg-green-900/20' : 'bg-red-50 dark:bg-red-900/20' }}">
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $label }}</span>
                            <p class="text-sm font-medium {{ $val === 'GOOD' ? 'text-green-700 dark:text-green-300' : 'text-red-700 dark:text-red-300' }}">{{ $val }}</p>
                        </div>
                        @endforeach
                    </div>

                    {{-- Kondisi & Solusi --}}
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Kondisi & Solusi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Kondisi</span><p class="text-sm">{{ $asset->conditions }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Sub Kondisi</span><p class="text-sm">{{ $asset->sub_con }}</p></div>
                        <div class="md:col-span-2"><span class="text-xs text-gray-500 dark:text-gray-400">Note Kondisi</span><p class="text-sm">{{ $asset->note_con ?? '-' }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Solusi</span><p class="text-sm">{{ $asset->solution }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Note Solusi</span><p class="text-sm">{{ $asset->note_sol ?? '-' }}</p></div>
                    </div>

                    {{-- Fungsi --}}
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Fungsi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Fungsi</span><p class="text-sm">{{ $asset->functions }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Note Fungsi</span><p class="text-sm">{{ $asset->note_func ?? '-' }}</p></div>
                    </div>

                    {{-- Lokasi & PIC --}}
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Lokasi & PIC</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Location</span><p class="text-sm">{{ $asset->location }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Note Location</span><p class="text-sm">{{ $asset->note_loc }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Status</span>
                            <p class="text-sm"><span class="px-2 py-1 text-xs rounded
                                @if($asset->status === 'IN USE') bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300
                                @elseif($asset->status === 'IN STORE') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300
                                @elseif($asset->status === 'IN REPAIR') bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300
                                @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                @endif">{{ $asset->status }}</span></p>
                        </div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">PIC Name</span><p class="text-sm">{{ $asset->pic_name ?? '-' }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">PIC NIP</span><p class="text-sm">{{ $asset->pic_nip ?? '-' }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">History PIC</span><p class="text-sm">{{ $asset->history_pic ?? '-' }}</p></div>
                    </div>

                    {{-- Maintenance --}}
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Maintenance</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-6">
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Total Corrective</span><p class="text-sm">{{ $asset->total_maintenance_corr ?? 0 }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Last Corrective</span><p class="text-sm">{{ $asset->last_maintenance_corr ?? '-' }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Total Preventive</span><p class="text-sm">{{ $asset->total_maintenance_prev ?? 0 }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Last Preventive</span><p class="text-sm">{{ $asset->last_maintenance_prev ?? '-' }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Total Prediktif</span><p class="text-sm">{{ $asset->total_maintenance_pred ?? 0 }}</p></div>
                        <div><span class="text-xs text-gray-500 dark:text-gray-400">Last Prediktif</span><p class="text-sm">{{ $asset->last_maintenance_pred ?? '-' }}</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
