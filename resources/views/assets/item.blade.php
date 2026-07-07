<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('assets.category', $slug) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $itemName }}</h2>
            </div>
            @if($slug === 'computing-devices' && $itemName === 'LAPTOP')
            <div class="flex gap-2">
                <form action="{{ route('assets.compd-lapt.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                    @csrf
                    <input type="file" name="file" accept=".csv,.txt" class="text-xs text-gray-500 dark:text-gray-400 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100" required>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1.5 px-3 rounded text-xs flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Import CSV
                    </button>
                </form>
                <a href="{{ route('assets.compd-lapt.export') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-1.5 px-3 rounded text-xs flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Export CSV
                </a>
                <a href="{{ route('assets.compd-lapt.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1.5 px-3 rounded text-xs flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Asset
                </a>
            </div>
            @elseif($slug === 'peripheral-devices' && $itemName === 'MOUSE')
            <div class="flex gap-2">
                <form action="{{ route('assets.perid-mous.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                    @csrf
                    <input type="file" name="file" accept=".csv,.txt" class="text-xs text-gray-500 dark:text-gray-400 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100" required>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1.5 px-3 rounded text-xs flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Import CSV
                    </button>
                </form>
                <a href="{{ route('assets.perid-mous.export') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-1.5 px-3 rounded text-xs flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Export CSV
                </a>
                <a href="{{ route('assets.perid-mous.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1.5 px-3 rounded text-xs flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Asset
                </a>
            </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-800 dark:text-green-300 rounded-lg text-sm">
                {{ session('success') }}
            </div>
            @endif
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
                                    @if($slug === 'computing-devices' && $itemName === 'LAPTOP')
                                    <th class="text-left py-3 px-2">Processor</th>
                                    <th class="text-center py-3 px-2">RAM</th>
                                    <th class="text-center py-3 px-2">Storage</th>
                                    @elseif($slug === 'peripheral-devices' && $itemName === 'MOUSE')
                                    <th class="text-center py-3 px-2">Connection</th>
                                    @endif
                                    <th class="text-center py-3 px-2">Status</th>
                                    <th class="text-center py-3 px-2">PIC</th>
                                    <th class="text-center py-3 px-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $asset)
                                <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="py-3 px-2 font-mono text-xs">{{ $slug === 'computing-devices' && $itemName === 'LAPTOP' ? $asset->id_lapt : $asset->id_mous }}</td>
                                    <td class="py-3 px-2 font-mono text-xs">{{ $asset->hostname }}</td>
                                    <td class="py-3 px-2">{{ $asset->brand }}</td>
                                    <td class="py-3 px-2">{{ $asset->type }}</td>
                                    <td class="py-3 px-2 text-gray-500 dark:text-gray-400 font-mono text-xs">{{ $asset->sn }}</td>
                                    @if($slug === 'computing-devices' && $itemName === 'LAPTOP')
                                    <td class="py-3 px-2 text-xs">{{ $asset->processors }}</td>
                                    <td class="py-3 px-2 text-center">{{ $asset->ram_cap }} GB</td>
                                    <td class="py-3 px-2 text-center">{{ $asset->disk1_cap }} GB</td>
                                    @elseif($slug === 'peripheral-devices' && $itemName === 'MOUSE')
                                    <td class="py-3 px-2 text-center">{{ $asset->connection }}</td>
                                    @endif
                                    <td class="py-3 px-2 text-center">
                                        <span class="px-2 py-1 text-xs rounded
                                            @if($asset->status === 'IN USE') bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300
                                            @elseif($asset->status === 'IN STORE') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300
                                            @elseif($asset->status === 'IN REPAIR') bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300
                                            @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                            @endif">{{ $asset->status }}</span>
                                    </td>
                                    <td class="py-3 px-2 text-center text-xs">{{ $asset->pic_name }}</td>
                                    <td class="py-3 px-2 text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            @if($slug === 'computing-devices' && $itemName === 'LAPTOP')
                                            <a href="{{ route('assets.compd-lapt.show', $asset->id_lapt) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 p-1" title="View">
                                            @elseif($slug === 'peripheral-devices' && $itemName === 'MOUSE')
                                            <a href="{{ route('assets.perid-mous.show', $asset->id_mous) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 p-1" title="View">
                                            @endif
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            @if($slug === 'computing-devices' && $itemName === 'LAPTOP')
                                            <a href="{{ route('assets.compd-lapt.edit', $asset->id_lapt) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 p-1" title="Edit">
                                            @elseif($slug === 'peripheral-devices' && $itemName === 'MOUSE')
                                            <a href="{{ route('assets.perid-mous.edit', $asset->id_mous) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 p-1" title="Edit">
                                            @endif
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            @if($slug === 'computing-devices' && $itemName === 'LAPTOP')
                                            <form action="{{ route('assets.compd-lapt.destroy', $asset->id_lapt) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus asset {{ $asset->id_lapt }}?')">
                                            @elseif($slug === 'peripheral-devices' && $itemName === 'MOUSE')
                                            <form action="{{ route('assets.perid-mous.destroy', $asset->id_mous) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus asset {{ $asset->id_mous }}?')">
                                            @endif
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 p-1" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
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
            @if($slug === 'computing-devices' && $itemName === 'LAPTOP')
                <div class="mt-4">
                    <a href="{{ route('assets.compd-lapt.create') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">
                        Tambah Laptop
                    </a>
                </div>
            @elseif($slug === 'peripheral-devices' && $itemName === 'MOUSE')
                <div class="mt-4">
                    <a href="{{ route('assets.perid-mous.create') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">
                        Tambah Mouse
                    </a>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
