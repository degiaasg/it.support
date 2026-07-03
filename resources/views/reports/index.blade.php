<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Laporan') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('reports.devices') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-lg mb-2">Laporan Perangkat</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Lihat dan filter data seluruh perangkat IT berdasarkan status dan kategori.</p>
                </a>
                <a href="{{ route('reports.maintenance') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-lg mb-2">Laporan Maintenance</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Riwayat maintenance dengan total biaya, filter berdasarkan tanggal dan perangkat.</p>
                </a>
                <a href="{{ route('reports.tickets') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-lg mb-2">Laporan Tiket</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Rekap tiket maintenance berdasarkan status, priority, dan periode.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
