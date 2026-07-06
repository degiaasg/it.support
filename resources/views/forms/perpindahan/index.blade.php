<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
            <a href="{{ url()->previous() }}" class="bg-gray-500 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
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
                                <th class="text-left py-3 px-2">Asset</th>
                                <th class="text-left py-3 px-2">Tgl. Pindah</th>
                                <th class="text-left py-3 px-2">Dari Lokasi</th>
                                <th class="text-left py-3 px-2">Ke Lokasi</th>
                                <th class="text-left py-3 px-2">Penanggung Jawab</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-3 px-2 font-medium">{{ $item->no_form }}</td>
                                <td class="py-3 px-2">{{ $item->asset_name }}</td>
                                <td class="py-3 px-2">{{ $item->tanggal_pindah }}</td>
                                <td class="py-3 px-2">{{ $item->dari_lokasi }}</td>
                                <td class="py-3 px-2">{{ $item->ke_lokasi }}</td>
                                <td class="py-3 px-2">{{ $item->penanggung_jawab }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500 dark:text-gray-400">Belum ada data {{ $title }}.</td>
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
