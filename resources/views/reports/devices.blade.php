<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Laporan Perangkat') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
                <form method="GET" class="flex gap-4 items-end">
                    <div>
                        <label class="block text-xs text-gray-500">Status</label>
                        <select name="status" class="rounded-md border-gray-300 text-sm">
                            <option value="">Semua</option>
                            @foreach(['available', 'in_use', 'under_maintenance', 'retired'] as $s)
                            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500">Kategori</label>
                        <select name="category_id" class="rounded-md border-gray-300 text-sm">
                            <option value="">Semua</option>
                            @foreach($categories as $id => $name)
                            <option value="{{ $id }}" {{ request('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded">Filter</button>
                    </div>
                    <div>
                        <a href="{{ route('reports.export.devices', request()->query()) }}" class="bg-green-500 hover:bg-green-700 text-white text-sm py-2 px-4 rounded inline-block">Export PDF</a>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Nama</th>
                                <th class="text-left py-2">Kategori</th>
                                <th class="text-left py-2">Brand</th>
                                <th class="text-left py-2">Serial Number</th>
                                <th class="text-center py-2">Status</th>
                                <th class="text-right py-2">Total Biaya Maintenance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($devices as $device)
                            <tr class="border-b">
                                <td class="py-2">{{ $device->name }}</td>
                                <td class="py-2">{{ $device->category->name }}</td>
                                <td class="py-2">{{ $device->brand ?? '-' }}</td>
                                <td class="py-2">{{ $device->serial_number ?? '-' }}</td>
                                <td class="py-2 text-center">{{ ucfirst($device->status) }}</td>
                                <td class="py-2 text-right">Rp {{ number_format($device->maintenanceLogs->sum('cost'), 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
