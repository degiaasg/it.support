<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
            <a href="{{ route('forms.pemeriksaan') }}" class="bg-gray-500 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Pilih Kategori Asset untuk menentukan form pemeriksaan yang sesuai:</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($kategoriList as $code => $label)
                        <a href="{{ route('forms.pemeriksaan.create-form', $code) }}" class="flex items-center gap-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:border-indigo-300 dark:hover:border-indigo-700 transition-colors duration-150">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center shrink-0">
                                <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ $code }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $code }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $label }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
