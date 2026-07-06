<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
            <div class="flex items-center gap-2">
                <a href="{{ route('forms.pemeriksaan.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Data
                </a>
                <a href="{{ url()->previous() }}" class="bg-gray-500 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-sm flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
            </div>
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
                                <th class="text-left py-3 px-2">No. Form</th>
                                <th class="text-left py-3 px-2">Kategori</th>
                                <th class="text-left py-3 px-2">Perangkat</th>
                                <th class="text-left py-3 px-2">Tanggal</th>
                                <th class="text-left py-3 px-2">Pemeriksa</th>
                                <th class="text-left py-3 px-2">Hasil</th>
                                @if(in_array(auth()->user()->role, ['admin', 'technician']))
                                <th class="text-center py-3 px-2">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-3 px-2 font-medium text-xs">{{ $item->no_form }}</td>
                                <td class="py-3 px-2">
                                    <span class="px-2 py-0.5 text-xs rounded bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300">{{ $item->kategori_asset }}</span>
                                </td>
                                <td class="py-3 px-2">{{ $item->device_name }}</td>
                                <td class="py-3 px-2">{{ \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->translatedFormat('d/m/Y') }}</td>
                                <td class="py-3 px-2">{{ $item->pemeriksa }}</td>
                                <td class="py-3 px-2">{{ Str::limit($item->hasil_pemeriksaan, 50) }}</td>
                                @if(in_array(auth()->user()->role, ['admin', 'technician']))
                                <td class="py-3 px-2 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('forms.pemeriksaan.show', $item->id) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-1 px-2 rounded text-xs">Print</a>
                                        <a href="{{ route('forms.pemeriksaan.edit', $item->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-1 px-2 rounded text-xs">Edit</a>
                                        <form action="{{ route('forms.pemeriksaan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ in_array(auth()->user()->role, ['admin', 'technician']) ? 7 : 6 }}" class="py-6 text-center text-gray-500 dark:text-gray-400">Belum ada data {{ $title }}.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $data->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
