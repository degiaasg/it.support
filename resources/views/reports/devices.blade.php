<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Laporan Perangkat') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6 mb-4">
                <form method="GET" class="flex gap-4 items-end">
                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400">Status</label>
                        <select name="status" class="rounded-md border-gray-300 dark:border-gray-600 text-sm">
                            <option value="">Semua</option>
                            @foreach(['available', 'in_use', 'under_maintenance', 'retired'] as $s)
                            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400">Kategori</label>
                        <select name="category_id" class="rounded-md border-gray-300 dark:border-gray-600 text-sm">
                            <option value="">Semua</option>
                            @foreach($categories as $id => $name)
                            <option value="{{ $id }}" {{ request('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white dark:bg-blue-600 dark:hover:bg-blue-500 text-sm py-2 px-4 rounded">Filter</button>
                    </div>
                    <div>
                        <a href="{{ route('reports.export.devices', request()->query()) }}" class="bg-green-500 hover:bg-green-700 text-white dark:bg-green-600 dark:hover:bg-green-500 text-sm py-2 px-4 rounded inline-block">Export PDF</a>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                        </thead>
                        <tbody>
                            @forelse($devices as $device)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $device->name }}</td>
                                <td class="py-2">{{ $device->category->name }}</td>
                                <td class="py-2">{{ $device->brand ?? '-' }}</td>
                                <td class="py-2">{{ $device->serial_number ?? '-' }}</td>
                                <td class="py-2 text-center">{{ ucfirst($device->status) }}</td>
                                <td class="py-2 text-right">Rp {{ number_format($device->maintenanceLogs->sum('cost'), 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
