<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/50 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Manajemen Dokumen</p>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }} - {{ $itemName }}</p>
                        </div>
                    </div>

                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-12 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        <p class="text-gray-500 dark:text-gray-400 mb-2">Belum ada dokumen BAST untuk {{ $itemName }}.</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Fitur upload akan segera tersedia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
