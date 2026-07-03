<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Tiket') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('tickets.update', $ticket) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Perangkat</label>
                        <select name="device_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            @foreach($devices as $device)
                            <option value="{{ $device->id }}" {{ old('device_id', $ticket->device_id) == $device->id ? 'selected' : '' }}>
                                {{ $device->name }} ({{ $device->serial_number ?? '-' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $ticket->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('description', $ticket->description) }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @foreach(['open', 'in_progress', 'resolved', 'closed'] as $s)
                                <option value="{{ $s }}" {{ old('status', $ticket->status) == $s ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($s)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Priority</label>
                            <select name="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @foreach(['low', 'medium', 'high', 'urgent'] as $p)
                                <option value="{{ $p }}" {{ old('priority', $ticket->priority) == $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(auth()->user()->role !== 'user')
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Teknisi</label>
                            <select name="assigned_to" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Teknisi</option>
                                @foreach($technicians as $id => $name)
                                <option value="{{ $id }}" {{ old('assigned_to', $ticket->assigned_to) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">Update</button>
                        <a href="{{ route('tickets.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-sm">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
