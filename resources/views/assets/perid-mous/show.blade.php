<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('assets.item', ['slug' => 'peripheral-devices', 'item' => 'mouse']) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Detail Mouse - {{ $asset->id_mous }}</h2>
            </div>
            <a href="{{ route('assets.perid-mous.edit', $asset->id_mous) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">
                Edit
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">ID Asset</label>
                            <p class="mt-1 text-sm font-mono text-gray-900 dark:text-gray-100">{{ $asset->id_mous }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Hostname</label>
                            <p class="mt-1 text-sm font-mono text-gray-900 dark:text-gray-100">{{ $asset->hostname }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Serial Number</label>
                            <p class="mt-1 text-sm font-mono text-gray-900 dark:text-gray-100">{{ $asset->sn }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Barcode</label>
                            <p class="mt-1 text-sm font-mono text-gray-900 dark:text-gray-100">{{ $asset->barcode }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Brand</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->brand }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Type</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->type }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Casing</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->casing }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Connection</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->connection }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Conditions</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->conditions }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Sub Condition</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->sub_con }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Solution</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->solution }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Function</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->functions }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Status</label>
                            <p class="mt-1">
                                <span class="px-2 py-1 text-xs rounded
                                    @if($asset->status === 'IN USE') bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300
                                    @elseif($asset->status === 'IN STORE') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300
                                    @elseif($asset->status === 'IN REPAIR') bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300
                                    @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                    @endif">{{ $asset->status }}</span>
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">PIC NIP</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->pic_nip ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">PIC Name</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->pic_name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Location</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->location }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Note Location</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->note_loc }}</p>
                        </div>
                    </div>

                    @if($asset->note_con)
                    <div class="mt-6">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Note Condition</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->note_con }}</p>
                    </div>
                    @endif

                    @if($asset->note_sol)
                    <div class="mt-4">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Note Solution</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->note_sol }}</p>
                    </div>
                    @endif

                    @if($asset->note_func)
                    <div class="mt-4">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Note Function</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->note_func }}</p>
                    </div>
                    @endif

                    @if($asset->history_pic)
                    <div class="mt-4">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">History PIC</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->history_pic }}</p>
                    </div>
                    @endif

                    {{-- Maintenance Info --}}
                    <div class="mt-6 pt-6 border-t">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Maintenance</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Total Corrective</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->total_maintenance_corr }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Last Corrective</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->last_maintenance_corr ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Total Preventive</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->total_maintenance_prev }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Last Preventive</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->last_maintenance_prev ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Total Prediktif</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->total_maintenance_pred }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Last Prediktif</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $asset->last_maintenance_pred ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
