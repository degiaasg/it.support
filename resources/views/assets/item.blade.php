<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('assets.category', $slug) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $itemName }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($assets->count())
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3 px-2">ID Asset</th>
                                    <th class="text-left py-3 px-2">Hostname</th>
                                    <th class="text-left py-3 px-2">Brand</th>
                                    <th class="text-left py-3 px-2">Type</th>
                                    <th class="text-left py-3 px-2">Serial Number</th>
                                    <th class="text-left py-3 px-2">Processor</th>
                                    <th class="text-center py-3 px-2">RAM</th>
                                    <th class="text-center py-3 px-2">Storage</th>
                                    <th class="text-center py-3 px-2">Status</th>
                                    <th class="text-center py-3 px-2">PIC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $asset)
                                <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="py-3 px-2 font-mono text-xs">{{ $asset->id_lapt }}</td>
                                    <td class="py-3 px-2 font-mono text-xs">{{ $asset->hostname }}</td>
                                    <td class="py-3 px-2">{{ $asset->brand }}</td>
                                    <td class="py-3 px-2">{{ $asset->type }}</td>
                                    <td class="py-3 px-2 text-gray-500 dark:text-gray-400 font-mono text-xs">{{ $asset->sn }}</td>
                                    <td class="py-3 px-2 text-xs">{{ $asset->processors }}</td>
                                    <td class="py-3 px-2 text-center">{{ $asset->ram_cap }} GB</td>
                                    <td class="py-3 px-2 text-center">{{ $asset->disk1_cap }} GB</td>
                                    <td class="py-3 px-2 text-center">
                                        <span class="px-2 py-1 text-xs rounded
                                            @if($asset->status === 'IN USE') bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300
                                            @elseif($asset->status === 'IN STORE') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300
                                            @elseif($asset->status === 'IN REPAIR') bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300
                                            @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                            @endif">{{ $asset->status }}</span>
                                    </td>
                                    <td class="py-3 px-2 text-center text-xs">{{ $asset->pic_name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $assets->links() }}
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <p class="text-gray-500 dark:text-gray-400">Belum ada data {{ $itemName }}.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
