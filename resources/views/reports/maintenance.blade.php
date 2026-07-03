<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Laporan Maintenance') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6 mb-4">
                <form method="GET" class="flex gap-4 items-end flex-wrap">
                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400">Dari Tanggal</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="rounded-md border-gray-300 dark:border-gray-600 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400">Sampai Tanggal</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="rounded-md border-gray-300 dark:border-gray-600 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400">Perangkat</label>
                        <select name="device_id" class="rounded-md border-gray-300 dark:border-gray-600 text-sm">
                            <option value="">Semua</option>
                            @foreach($devices as $id => $name)
                            <option value="{{ $id }}" {{ request('device_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white dark:bg-blue-600 dark:hover:bg-blue-500 text-sm py-2 px-4 rounded">Filter</button>
                    </div>
                    <div>
                        <a href="{{ route('reports.export.maintenance', request()->query()) }}" class="bg-green-500 hover:bg-green-700 text-white dark:bg-green-600 dark:hover:bg-green-500 text-sm py-2 px-4 rounded inline-block">Export PDF</a>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6 mb-4">
                <p class="text-lg font-semibold">Total Biaya Maintenance: <span class="text-blue-600 dark:text-blue-400">Rp {{ number_format($totalCost, 0, ',', '.') }}</span></p>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="text-left py-2">Tanggal</th>
                                <th class="text-left py-2">Perangkat</th>
                                <th class="text-left py-2">Tipe</th>
                                <th class="text-left py-2">Deskripsi</th>
                                <th class="text-left py-2">Teknisi</th>
                                <th class="text-right py-2">Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $log->performed_at->format('d/m/Y') }}</td>
                                <td class="py-2">{{ $log->device->name }}</td>
                                <td class="py-2">{{ ucfirst($log->maintenance_type) }}</td>
                                <td class="py-2 max-w-xs truncate">{{ $log->description }}</td>
                                <td class="py-2">{{ $log->user->name }}</td>
                                <td class="py-2 text-right">Rp {{ number_format($log->cost, 0, ',', '.') }}</td>
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
