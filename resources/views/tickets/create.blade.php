<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Buat Tiket Baru') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6">
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    @if(auth()->user()->role !== 'user' && $users->count())
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pelapor</label>
                        <select name="user_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih Pelapor</option>
                            @foreach($users as $id => $name)
                            <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Perangkat</label>
                        <select name="device_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Perangkat</option>
                            @foreach($devices as $device)
                            <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                                {{ $device->name }} ({{ $device->serial_number ?? '-' }}) - {{ $device->category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                            <select name="priority" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500" required>
                                @foreach(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High', 'urgent' => 'Urgent'] as $val => $label)
                                <option value="{{ $val }}" {{ old('priority') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(auth()->user()->role !== 'user')
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Assign ke Teknisi</label>
                            <select name="assigned_to" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:shadow-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Teknisi</option>
                                @foreach($technicians as $id => $name)
                                <option value="{{ $id }}" {{ old('assigned_to') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 dark:bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">Simpan</button>
                        <a href="{{ route('tickets.index') }}" class="bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded text-sm">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
