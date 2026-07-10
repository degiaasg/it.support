<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/50 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Manajemen Dokumen</p>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }}</p>
                        </div>
                    </div>

                    @if($type === 'bast')
                        @php
                            $assetCategories = [
                                'computing-devices' => 'Computing Device',
                                'data-center-infrastructure' => 'Data Center Infrastructure',
                                'mobile-devices' => 'Mobile Devices',
                                'networking-devices' => 'Networking Devices',
                                'peripheral-devices' => 'Peripheral Devices',
                                'security-devices' => 'Security Devices',
                                'storage-devices' => 'Storage Devices',
                                'telecommunication-devices' => 'Telecommunication Devices',
                            ];
                            $assetCategoryItems = [
                                'computing-devices' => ['LAPTOP', 'NOTEBOOK', 'DESKTOP', 'PC', 'WORKSTATION', 'SERVER', 'MINI PC', 'NUC', 'ALL-IN-ONE PC', 'THIN CLIENT', 'ZERO CLIENT'],
                                'mobile-devices' => ['SMARTPHONE', 'TABLET', 'HANDHELD SCANNER', 'RUGGED DEVICE'],
                                'networking-devices' => ['ROUTER', 'SWITCH MANAGED', 'SWITCH UNMANAGED', 'ACCESS POINT', 'FIREWALL', 'MODEM', 'LOAD BALANCER', 'WIRELESS CONTROLLER'],
                                'storage-devices' => ['NAS (NETWORK ATTACHED STORAGE)', 'SAN (STORAGE AREA NETWORK)', 'EXTERNAL HDD/SSD', 'TAPE DRIVE / LIBRARY', 'FLASH DRIVE'],
                                'peripheral-devices' => ['PRINTER', 'SCANNER', 'MONITOR DISPLAY', 'TV', 'PROJECTOR', 'UPS', 'DOCKING STATION', 'WEBCAM & CONFERENCE KIT', 'KEYBOARD', 'MOUSE'],
                                'security-devices' => ['IP CAMERA / CCTV', 'BIOMETRIC SCANNER', 'ACCESS CONTROL PANEL', 'HARDWARE SECURITY MODULE (HSM)', 'USB LOCK / PHYSICAL LOCK'],
                                'telecommunication-devices' => ['IP PHONE / VOIP', 'PBX SYSTEM', 'VIDEO CONFERENCE SYSTEM', 'INTERCOM SYSTEM', 'SERVER RACK', 'PDU (POWER DISTRIBUTION UNIT)', 'KVM SWITCH', 'COOLING SYSTEM', 'ENVIRONMENTAL SENSOR'],
                                'data-center-infrastructure' => ['SERVER RACK', 'PDU (POWER DISTRIBUTION UNIT)', 'KVM SWITCH', 'COOLING SYSTEM', 'ENVIRONMENTAL SENSOR'],
                            ];
                        @endphp
                        <div class="space-y-2">
                            @foreach($assetCategories as $key => $label)
                                @php $state = \Illuminate\Support\Str::camel($key) . 'Open'; @endphp
                                <div x-data="{ {{ $state }}: false }" class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-gray-700/50 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150" @click="{{ $state }} = ! {{ $state }}">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-5 h-5 text-indigo-500 dark:text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $label }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ count($assetCategoryItems[$key]) }} item</span>
                                            <svg :class="{'rotate-180': {{ $state }}}" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </div>
                                    </div>
                                    <div x-show="{{ $state }}" x-collapse class="border-t border-gray-200 dark:border-gray-700">
                                        <div class="divide-y divide-gray-100 dark:divide-gray-700">
                                            @foreach($assetCategoryItems[$key] as $item)
                                                @php $itemSlug = \Illuminate\Support\Str::slug($item); @endphp
                                                <a href="{{ route('documents.bast', ['category' => $key, 'item' => $itemSlug]) }}" class="flex items-center gap-3 px-4 py-2.5 pl-12 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-600 shrink-0"></span>
                                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $item }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-12 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        <p class="text-gray-500 dark:text-gray-400 mb-2">Belum ada dokumen {{ $title }}.</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Fitur upload akan segera tersedia.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
