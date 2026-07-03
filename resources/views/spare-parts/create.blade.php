<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Tambah Spare Part') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6">
                <form action="{{ route('spare-parts.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Spare Part</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Part Number</label>
                            <input type="text" name="part_number" value="{{ old('part_number') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                            @error('part_number') <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                            <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Minimum Stok</label>
                            <input type="number" name="minimum_stock" value="{{ old('minimum_stock', 1) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Satuan (Rp)</label>
                            <input type="number" name="unit_price" value="{{ old('unit_price', 0) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white dark:bg-blue-600 dark:hover:bg-blue-500 font-bold py-2 px-4 rounded text-sm">Simpan</button>
                        <a href="{{ route('spare-parts.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-gray-200 font-bold py-2 px-4 rounded text-sm">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
