<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Edit Perangkat') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6">
                <form action="{{ route('devices.update', $device) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                            <select name="category_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                                @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id', $device->category_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perangkat</label>
                            <input type="text" name="name" value="{{ old('name', $device->name) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Brand</label>
                            <input type="text" name="brand" value="{{ old('brand', $device->brand) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model</label>
                            <input type="text" name="model" value="{{ old('model', $device->model) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Serial Number</label>
                            <input type="text" name="serial_number" value="{{ old('serial_number', $device->serial_number) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                                @foreach(['available' => 'Available', 'in_use' => 'In Use', 'under_maintenance' => 'Under Maintenance', 'retired' => 'Retired'] as $val => $label)
                                <option value="{{ $val }}" {{ old('status', $device->status) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pembelian</label>
                            <input type="date" name="purchase_date" value="{{ old('purchase_date', $device->purchase_date?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Garansi Hingga</label>
                            <input type="date" name="warranty_expiry" value="{{ old('warranty_expiry', $device->warranty_expiry?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</label>
                        <textarea name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500">{{ old('notes', $device->notes) }}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 dark:bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">Update</button>
                        <a href="{{ route('devices.index') }}" class="bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded text-sm">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
