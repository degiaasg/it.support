<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Inventaris Perangkat') }}</h2>
            @if(auth()->user()->role !== 'user')
            <a href="{{ route('devices.create') }}" class="bg-blue-500 dark:bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">+ Tambah Perangkat</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/50 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-2">Nama</th>
                                <th class="text-left py-3 px-2">Kategori</th>
                                <th class="text-left py-3 px-2">Brand</th>
                                <th class="text-left py-3 px-2">Serial Number</th>
                                <th class="text-center py-3 px-2">Status</th>
                                <th class="text-center py-3 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($devices as $device)
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-3 px-2 font-medium">
                                    <a href="{{ route('devices.show', $device) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $device->name }}</a>
                                </td>
                                <td class="py-3 px-2">{{ $device->category->name }}</td>
                                <td class="py-3 px-2">{{ $device->brand ?? '-' }}</td>
                                <td class="py-3 px-2 text-gray-500 dark:text-gray-400">{{ $device->serial_number ?? '-' }}</td>
                                <td class="py-3 px-2 text-center">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($device->status === 'available') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300
                                        @elseif($device->status === 'in_use') bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300
                                        @elseif($device->status === 'under_maintenance') bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300
                                        @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                        @endif">{{ str_replace('_', ' ', ucfirst($device->status)) }}</span>
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ route('devices.show', $device) }}" class="text-gray-600 dark:text-gray-400 hover:underline text-xs me-2">Detail</a>
                                    @if(auth()->user()->role !== 'user')
                                    <a href="{{ route('devices.edit', $device) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs me-2">Edit</a>
                                    <form action="{{ route('devices.destroy', $device) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-xs">Hapus</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500 dark:text-gray-400">Belum ada perangkat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $devices->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
