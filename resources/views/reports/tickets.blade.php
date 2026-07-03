<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Laporan Tiket') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
                <form method="GET" class="flex gap-4 items-end flex-wrap">
                    <div>
                        <label class="block text-xs text-gray-500">Status</label>
                        <select name="status" class="rounded-md border-gray-300 text-sm">
                            <option value="">Semua</option>
                            @foreach(['open', 'in_progress', 'resolved', 'closed'] as $s)
                            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500">Priority</label>
                        <select name="priority" class="rounded-md border-gray-300 text-sm">
                            <option value="">Semua</option>
                            @foreach(['low', 'medium', 'high', 'urgent'] as $p)
                            <option value="{{ $p }}" {{ request('priority') == $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500">Dari Tanggal</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="rounded-md border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500">Sampai Tanggal</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="rounded-md border-gray-300 text-sm">
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-2 px-4 rounded">Filter</button>
                    </div>
                    <div>
                        <a href="{{ route('reports.export.tickets', request()->query()) }}" class="bg-green-500 hover:bg-green-700 text-white text-sm py-2 px-4 rounded inline-block">Export PDF</a>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Tanggal</th>
                                <th class="text-left py-2">Judul</th>
                                <th class="text-left py-2">Pelapor</th>
                                <th class="text-left py-2">Perangkat</th>
                                <th class="text-center py-2">Priority</th>
                                <th class="text-center py-2">Status</th>
                                <th class="text-left py-2">Teknisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                            <tr class="border-b">
                                <td class="py-2">{{ $ticket->created_at->format('d/m/Y') }}</td>
                                <td class="py-2">{{ $ticket->title }}</td>
                                <td class="py-2">{{ $ticket->user->name }}</td>
                                <td class="py-2">{{ $ticket->device->name }}</td>
                                <td class="py-2 text-center">{{ ucfirst($ticket->priority) }}</td>
                                <td class="py-2 text-center">{{ str_replace('_', ' ', ucfirst($ticket->status)) }}</td>
                                <td class="py-2">{{ $ticket->assignedTo->name ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-4 text-center text-gray-500">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
