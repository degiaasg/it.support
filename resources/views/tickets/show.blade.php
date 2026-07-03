<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $ticket->title }}</h2>
            <div class="flex gap-2">
                @if(auth()->user()->role !== 'user')
                    @if($ticket->status === 'open')
                    <form action="{{ route('tickets.assign', $ticket) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <select name="assigned_to" onchange="this.form.submit()" class="rounded-md border-gray-300 text-sm">
                            <option value="">Assign ke...</option>
                            @foreach(\App\Models\User::whereIn('role', ['admin', 'technician'])->pluck('name', 'id') as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </form>
                    @endif
                    @if($ticket->status === 'in_progress')
                    <form action="{{ route('tickets.resolve', $ticket) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">Tandai Selesai</button>
                    </form>
                    @endif
                    @if($ticket->status === 'resolved')
                    <form action="{{ route('tickets.close', $ticket) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">Tutup Tiket</button>
                    </form>
                    @endif
                    <a href="{{ route('tickets.edit', $ticket) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">Edit</a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                        <h3 class="font-semibold text-lg mb-4">Detail Tiket</h3>
                        <table class="min-w-full text-sm">
                            <tr class="border-b">
                                <td class="py-2 font-medium w-40">Pelapor</td>
                                <td class="py-2">{{ $ticket->user->name }} ({{ $ticket->user->email }})</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Perangkat</td>
                                <td class="py-2">{{ $ticket->device->name }} - {{ $ticket->device->category->name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Priority</td>
                                <td class="py-2">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($ticket->priority === 'urgent') bg-red-100 text-red-800
                                        @elseif($ticket->priority === 'high') bg-orange-100 text-orange-800
                                        @elseif($ticket->priority === 'medium') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">{{ ucfirst($ticket->priority) }}</span>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Status</td>
                                <td class="py-2">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($ticket->status === 'open') bg-yellow-100 text-yellow-800
                                        @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800
                                        @elseif($ticket->status === 'resolved') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">{{ str_replace('_', ' ', ucfirst($ticket->status)) }}</span>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Ditugaskan ke</td>
                                <td class="py-2">{{ $ticket->assignedTo->name ?? 'Belum ditugaskan' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium">Deskripsi</td>
                                <td class="py-2">{{ $ticket->description }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-4">Log Maintenance Terkait</h3>
                        @if($ticket->maintenanceLogs->count())
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2">Tanggal</th>
                                    <th class="text-left py-2">Tipe</th>
                                    <th class="text-left py-2">Deskripsi</th>
                                    <th class="text-left py-2">Teknisi</th>
                                    <th class="text-right py-2">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ticket->maintenanceLogs as $log)
                                <tr class="border-b">
                                    <td class="py-2">{{ $log->performed_at->format('d/m/Y') }}</td>
                                    <td class="py-2">{{ ucfirst($log->maintenance_type) }}</td>
                                    <td class="py-2">{{ Str::limit($log->description, 50) }}</td>
                                    <td class="py-2">{{ $log->user->name }}</td>
                                    <td class="py-2 text-right">Rp {{ number_format($log->cost, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-gray-500">Belum ada log maintenance.</p>
                        @endif
                    </div>
                </div>

                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-4">Aksi Cepat</h3>
                        <div class="space-y-2">
                            <a href="{{ route('maintenance-logs.create', ['ticket_id' => $ticket->id]) }}" class="block w-full text-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">+ Tambah Log Maintenance</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
