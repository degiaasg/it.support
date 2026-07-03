<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Spare Parts') }}</h2>
            <a href="{{ route('spare-parts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">+ Tambah Spare Part</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-2">Nama</th>
                                <th class="text-left py-3 px-2">Part Number</th>
                                <th class="text-center py-3 px-2">Stok</th>
                                <th class="text-center py-3 px-2">Min. Stok</th>
                                <th class="text-right py-3 px-2">Harga Satuan</th>
                                <th class="text-center py-3 px-2">Status</th>
                                <th class="text-center py-3 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($parts as $part)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-2 font-medium">{{ $part->name }}</td>
                                <td class="py-3 px-2 text-gray-500">{{ $part->part_number }}</td>
                                <td class="py-3 px-2 text-center">{{ $part->quantity }}</td>
                                <td class="py-3 px-2 text-center">{{ $part->minimum_stock }}</td>
                                <td class="py-3 px-2 text-right">Rp {{ number_format($part->unit_price, 0, ',', '.') }}</td>
                                <td class="py-3 px-2 text-center">
                                    @if($part->quantity <= 0)
                                    <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">Habis</span>
                                    @elseif($part->quantity <= $part->minimum_stock)
                                    <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">Menipis</span>
                                    @else
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Tersedia</span>
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ route('spare-parts.edit', $part) }}" class="text-blue-600 hover:underline text-xs me-2">Edit</a>
                                    <form action="{{ route('spare-parts.destroy', $part) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-gray-500">Belum ada spare part.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $parts->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
