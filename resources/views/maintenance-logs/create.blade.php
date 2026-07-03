<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tambah Log Maintenance') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('maintenance-logs.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Perangkat</label>
                            <select name="device_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">Pilih Perangkat</option>
                                @foreach($devices as $device)
                                <option value="{{ $device->id }}" {{ old('device_id', request('device_id')) == $device->id ? 'selected' : '' }}>{{ $device->name }} ({{ $device->serial_number ?? '-' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Tipe Maintenance</label>
                            <select name="maintenance_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @foreach(['preventive' => 'Preventive', 'corrective' => 'Corrective', 'emergency' => 'Emergency'] as $val => $label)
                                <option value="{{ $val }}" {{ old('maintenance_type') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Tiket Terkait (Opsional)</label>
                            <select name="ticket_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Tidak ada tiket</option>
                                @foreach($tickets as $ticket)
                                <option value="{{ $ticket->id }}" {{ old('ticket_id', request('ticket_id')) == $ticket->id ? 'selected' : '' }}>{{ $ticket->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pelaksanaan</label>
                            <input type="date" name="performed_at" value="{{ old('performed_at', date('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Biaya (Rp)</label>
                            <input type="number" name="cost" value="{{ old('cost', 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Spare Parts Digunakan</label>
                        <div id="spare-parts-container">
                            <div class="flex gap-2 items-end spare-part-row">
                                <div class="flex-1">
                                    <select name="spare_parts[0][id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        <option value="">Pilih Spare Part</option>
                                        @foreach($spareParts as $part)
                                        <option value="{{ $part->id }}">{{ $part->name }} (Stok: {{ $part->quantity }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-24">
                                    <label class="block text-xs text-gray-500">Jumlah</label>
                                    <input type="number" name="spare_parts[0][quantity]" value="1" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>
                                <button type="button" onclick="this.closest('.spare-part-row').remove()" class="text-red-500 text-sm mt-2">Hapus</button>
                            </div>
                        </div>
                        <button type="button" onclick="addSparePartRow()" class="text-blue-600 text-sm mt-2">+ Tambah Spare Part</button>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">Simpan</button>
                        <a href="{{ route('maintenance-logs.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-sm">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let sparePartIndex = 1;
        function addSparePartRow() {
            const container = document.getElementById('spare-parts-container');
            const html = `
                <div class="flex gap-2 items-end spare-part-row mt-2">
                    <div class="flex-1">
                        <select name="spare_parts[${sparePartIndex}][id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Pilih Spare Part</option>
                            @foreach($spareParts as $part)
                            <option value="{{ $part->id }}">{{ $part->name }} (Stok: {{ $part->quantity }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-24">
                        <label class="block text-xs text-gray-500">Jumlah</label>
                        <input type="number" name="spare_parts[${sparePartIndex}][quantity]" value="1" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>
                    <button type="button" onclick="this.closest('.spare-part-row').remove()" class="text-red-500 text-sm mt-2">Hapus</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            sparePartIndex++;
        }
    </script>
    @endpush
</x-app-layout>
