<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Kategori Perangkat') }}</h2>
            <a href="{{ route('categories.create') }}" class="bg-blue-500 dark:bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">+ Tambah Kategori</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/50 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="bg-red-100 dark:bg-red-900/50 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-2">Nama</th>
                                <th class="text-left py-3 px-2">Slug</th>
                                <th class="text-left py-3 px-2">Deskripsi</th>
                                <th class="text-center py-3 px-2">Jumlah Perangkat</th>
                                <th class="text-center py-3 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-3 px-2 font-medium">{{ $category->name }}</td>
                                <td class="py-3 px-2 text-gray-500 dark:text-gray-400">{{ $category->slug }}</td>
                                <td class="py-3 px-2 text-gray-500 dark:text-gray-400">{{ Str::limit($category->description, 50) }}</td>
                                <td class="py-3 px-2 text-center">{{ $category->devices_count }}</td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs me-2">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500 dark:text-gray-400">Belum ada kategori.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $categories->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
