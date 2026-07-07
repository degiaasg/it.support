<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('assets.item', ['slug' => 'peripheral-devices', 'item' => 'mouse']) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($method === 'PUT') @method('PUT') @endif

                        {{-- Informasi Perangkat --}}
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Informasi Perangkat</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ID Asset</label>
                                <input type="text" name="id_mous" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('id_mous', $asset?->id_mous ?? $nextId) }}" {{ isset($asset) ? 'readonly' : '' }}>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hostname <span class="text-red-500">*</span></label>
                                <input type="text" name="hostname" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('hostname', $asset?->hostname ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Serial Number <span class="text-red-500">*</span></label>
                                <input type="text" name="sn" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('sn', $asset?->sn ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Barcode <span class="text-red-500">*</span></label>
                                <input type="text" name="barcode" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('barcode', $asset?->barcode ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Brand <span class="text-red-500">*</span></label>
                                <input type="text" name="brand" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('brand', $asset?->brand ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type <span class="text-red-500">*</span></label>
                                <input type="text" name="type" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('type', $asset?->type ?? '') }}" required>
                            </div>
                        </div>

                        {{-- Kondisi Hardware --}}
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Kondisi Hardware</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Casing <span class="text-red-500">*</span></label>
                                <select name="casing" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" required>
                                    <option value="">--</option>
                                    @foreach(['GOOD', 'BAD'] as $opt)
                                    <option value="{{ $opt }}" {{ old('casing', $asset?->casing ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Connection <span class="text-red-500">*</span></label>
                                <select name="connection" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" required>
                                    <option value="">--</option>
                                    @foreach(['Wireless USB', 'Bluetooth', 'Wire'] as $opt)
                                    <option value="{{ $opt }}" {{ old('connection', $asset?->connection ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Kondisi & Solusi --}}
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Kondisi & Solusi</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Conditions <span class="text-red-500">*</span></label>
                                <select name="conditions" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" required>
                                    <option value="">--</option>
                                    @foreach(['GOOD', 'BAD'] as $opt)
                                    <option value="{{ $opt }}" {{ old('conditions', $asset?->conditions ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sub Condition <span class="text-red-500">*</span></label>
                                <select name="sub_con" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" required>
                                    <option value="">--</option>
                                    @foreach(['GREAT', 'NORMAL', 'COUTIONS', 'POOR'] as $opt)
                                    <option value="{{ $opt }}" {{ old('sub_con', $asset?->sub_con ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Note Condition</label>
                                <textarea name="note_con" rows="2" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">{{ old('note_con', $asset?->note_con ?? '') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Solution <span class="text-red-500">*</span></label>
                                <select name="solution" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" required>
                                    <option value="">--</option>
                                    @foreach(['KEEP', 'UPGRADE', 'REPAIR', 'REPLACE', 'DISPOSE'] as $opt)
                                    <option value="{{ $opt }}" {{ old('solution', $asset?->solution ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Note Solution</label>
                                <textarea name="note_sol" rows="2" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">{{ old('note_sol', $asset?->note_sol ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- Fungsi --}}
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Fungsi</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Function <span class="text-red-500">*</span></label>
                                <select name="functions" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" required>
                                    <option value="">--</option>
                                    @foreach(['PERUSED', 'GROUP', 'SYSTEM', 'OPERATIONAL'] as $opt)
                                    <option value="{{ $opt }}" {{ old('functions', $asset?->functions ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Note Function</label>
                                <textarea name="note_func" rows="2" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">{{ old('note_func', $asset?->note_func ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- Lokasi & PIC --}}
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Lokasi & PIC</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location <span class="text-red-500">*</span></label>
                                <input type="text" name="location" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('location', $asset?->location ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Note Location <span class="text-red-500">*</span></label>
                                <input type="text" name="note_loc" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('note_loc', $asset?->note_loc ?? '') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status <span class="text-red-500">*</span></label>
                                <select name="status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" required>
                                    <option value="">--</option>
                                    @foreach(['IN USE', 'IN STORE', 'IN REPAIR', 'DISPOSING', 'DISPOSED', 'IN ACTIVE'] as $opt)
                                    <option value="{{ $opt }}" {{ old('status', $asset?->status ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">PIC Name</label>
                                <input type="text" name="pic_name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('pic_name', $asset?->pic_name ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">PIC NIP</label>
                                <input type="number" name="pic_nip" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('pic_nip', $asset?->pic_nip ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">History PIC</label>
                                <textarea name="history_pic" rows="2" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">{{ old('history_pic', $asset?->history_pic ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- Maintenance --}}
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Maintenance</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total Corrective</label>
                                <input type="number" name="total_maintenance_corr" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('total_maintenance_corr', $asset?->total_maintenance_corr ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Corrective</label>
                                <input type="date" name="last_maintenance_corr" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('last_maintenance_corr', $asset?->last_maintenance_corr ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total Preventive</label>
                                <input type="number" name="total_maintenance_prev" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('total_maintenance_prev', $asset?->total_maintenance_prev ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Preventive</label>
                                <input type="date" name="last_maintenance_prev" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('last_maintenance_prev', $asset?->last_maintenance_prev ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total Prediktif</label>
                                <input type="number" name="total_maintenance_pred" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('total_maintenance_pred', $asset?->total_maintenance_pred ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Prediktif</label>
                                <input type="date" name="last_maintenance_pred" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('last_maintenance_pred', $asset?->last_maintenance_pred ?? '') }}">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('assets.item', ['slug' => 'peripheral-devices', 'item' => 'mouse']) }}" class="px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">Batal</a>
                            <button type="submit" class="px-6 py-2 text-sm rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 font-medium">{{ $submitText }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
