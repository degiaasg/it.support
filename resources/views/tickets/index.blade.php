<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tiket Maintenance') }}</h2>
            <a href="{{ route('tickets.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">+ Buat Tiket</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
                <form method="GET" class="flex gap-4 items-end">
                    <div>
                        <label class="block text-xs text-gray-500">Status</label>
                        <select name="status" class="rounded-md border-gray-300 text-sm" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach(['open', 'in_progress', 'resolved', 'closed'] as $s)
                            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500">Priority</label>
                        <select name="priority" class="rounded-md border-gray-300 text-sm" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach(['low', 'medium', 'high', 'urgent'] as $p)
                            <option value="{{ $p }}" {{ request('priority') == $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-2">Judul</th>
                                <th class="text-left py-3 px-2">Pelapor</th>
                                <th class="text-left py-3 px-2">Perangkat</th>
                                <th class="text-center py-3 px-2">Priority</th>
                                <th class="text-center py-3 px-2">Status</th>
                                <th class="text-left py-3 px-2">Ditugaskan ke</th>
                                <th class="text-center py-3 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-2 font-medium">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:underline">{{ $ticket->title }}</a>
                                </td>
                                <td class="py-3 px-2">{{ $ticket->user->name }}</td>
                                <td class="py-3 px-2">{{ $ticket->device->name }}</td>
                                <td class="py-3 px-2 text-center">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($ticket->priority === 'urgent') bg-red-100 text-red-800
                                        @elseif($ticket->priority === 'high') bg-orange-100 text-orange-800
                                        @elseif($ticket->priority === 'medium') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">{{ ucfirst($ticket->priority) }}</span>
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($ticket->status === 'open') bg-yellow-100 text-yellow-800
                                        @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800
                                        @elseif($ticket->status === 'resolved') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">{{ str_replace('_', ' ', ucfirst($ticket->status)) }}</span>
                                </td>
                                <td class="py-3 px-2">{{ $ticket->assignedTo->name ?? '-' }}</td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:underline text-xs">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-gray-500">Belum ada tiket.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $tickets->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
