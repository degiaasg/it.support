<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Log Maintenance') }}</h2>
            <a href="{{ route('maintenance-logs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white dark:bg-blue-600 dark:hover:bg-blue-500 font-bold py-2 px-4 rounded text-sm">+ Tambah Log</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 dark:bg-green-900/50 dark:border-green-600 dark:text-green-300 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6 mb-4">
                <form method="GET" class="flex gap-4 items-end">
                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400">Tipe Maintenance</label>
                        <select name="maintenance_type" class="rounded-md border-gray-300 dark:border-gray-600 text-sm" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach(['preventive', 'corrective', 'emergency'] as $t)
                            <option value="{{ $t }}" {{ request('maintenance_type') == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400">Perangkat</label>
                        <select name="device_id" class="rounded-md border-gray-300 dark:border-gray-600 text-sm" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach($devices as $id => $name)
                            <option value="{{ $id }}" {{ request('device_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="text-left py-3 px-2">Tanggal</th>
                                <th class="text-left py-3 px-2">Perangkat</th>
                                <th class="text-left py-3 px-2">Tipe</th>
                                <th class="text-left py-3 px-2">Deskripsi</th>
                                <th class="text-left py-3 px-2">Teknisi</th>
                                <th class="text-right py-3 px-2">Biaya</th>
                                <th class="text-center py-3 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-3 px-2">{{ $log->performed_at->format('d/m/Y') }}</td>
                                <td class="py-3 px-2">{{ $log->device->name }}</td>
                                <td class="py-3 px-2">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($log->maintenance_type === 'preventive') bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300
                                        @elseif($log->maintenance_type === 'corrective') bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300
                                        @else bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300
                                        @endif">{{ ucfirst($log->maintenance_type) }}</span>
                                </td>
                                <td class="py-3 px-2 text-gray-500 dark:text-gray-400 max-w-xs truncate">{{ $log->description }}</td>
                                <td class="py-3 px-2">{{ $log->user->name }}</td>
                                <td class="py-3 px-2 text-right">Rp {{ number_format($log->cost, 0, ',', '.') }}</td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ route('maintenance-logs.show', $log) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-gray-500 dark:text-gray-400">Belum ada log maintenance.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $logs->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
