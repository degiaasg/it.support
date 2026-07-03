<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Spare Parts') }}</h2>
            <a href="{{ route('spare-parts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white dark:bg-blue-600 dark:hover:bg-blue-500 font-bold py-2 px-4 rounded text-sm">+ Tambah Spare Part</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 dark:bg-green-900/50 dark:border-green-600 dark:text-green-300 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                        </thead>
                        <tbody>
                            @forelse($parts as $part)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-3 px-2 font-medium">{{ $part->name }}</td>
                                <td class="py-3 px-2 text-gray-500 dark:text-gray-400">{{ $part->part_number }}</td>
                                <td class="py-3 px-2 text-center">{{ $part->quantity }}</td>
                                <td class="py-3 px-2 text-center">{{ $part->minimum_stock }}</td>
                                <td class="py-3 px-2 text-right">Rp {{ number_format($part->unit_price, 0, ',', '.') }}</td>
                                <td class="py-3 px-2 text-center">
                                    @if($part->quantity <= 0)
                                    <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">Habis</span>
                                    @elseif($part->quantity <= $part->minimum_stock)
                                    <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300">Menipis</span>
                                    @else
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">Tersedia</span>
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ route('spare-parts.edit', $part) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs me-2">Edit</a>
                                    <form action="{{ route('spare-parts.destroy', $part) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-gray-500 dark:text-gray-400">Belum ada spare part.</td>
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
