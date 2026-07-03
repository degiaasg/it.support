<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Total Perangkat</div>
                    <div class="text-3xl font-bold">{{ $stats['total_devices'] }}</div>
                    <div class="text-xs text-gray-400 mt-1">
                        Tersedia: {{ $stats['available_devices'] }} | Dipakai: {{ $stats['in_use_devices'] }} | Maintenance: {{ $stats['under_maintenance_devices'] }}
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Total Tiket</div>
                    <div class="text-3xl font-bold">{{ $stats['total_tickets'] }}</div>
                    <div class="text-xs text-gray-400 mt-1">
                        Open: {{ $stats['open_tickets'] }} | Progress: {{ $stats['in_progress_tickets'] }} | Selesai: {{ $stats['resolved_tickets'] }}
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Total Maintenance</div>
                    <div class="text-3xl font-bold">{{ $stats['total_maintenance_logs'] }}</div>
                    <div class="text-xs text-gray-400 mt-1">Total Biaya: Rp {{ number_format($stats['total_maintenance_cost'], 0, ',', '.') }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Spare Parts</div>
                    <div class="text-3xl font-bold">{{ $stats['low_stock_parts'] }}</div>
                    <div class="text-xs text-gray-400 mt-1">Stok menipis</div>
                </div>
            </div>

            @if(auth()->user()->role !== 'user')
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-lg mb-4">Status Perangkat</h3>
                    <div class="space-y-2">
                        @foreach(['available' => 'Tersedia', 'in_use' => 'Digunakan', 'under_maintenance' => 'Maintenance', 'retired' => 'Pensiun'] as $key => $label)
                        <div class="flex items-center">
                            <span class="w-32 text-sm">{{ $label }}</span>
                            <div class="flex-1 bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $stats['total_devices'] > 0 ? ($deviceStatuses[$key] ?? 0) / $stats['total_devices'] * 100 : 0 }}%"></div>
                            </div>
                            <span class="w-10 text-right text-sm">{{ $deviceStatuses[$key] ?? 0 }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-lg mb-4">Status Tiket</h3>
                    <div class="space-y-2">
                        @foreach(['open' => 'Open', 'in_progress' => 'In Progress', 'resolved' => 'Resolved', 'closed' => 'Closed'] as $key => $label)
                        <div class="flex items-center">
                            <span class="w-24 text-sm">{{ $label }}</span>
                            <div class="flex-1 bg-gray-200 rounded-full h-2.5">
                                <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $stats['total_tickets'] > 0 ? ($ticketStatuses[$key] ?? 0) / $stats['total_tickets'] * 100 : 0 }}%"></div>
                            </div>
                            <span class="w-10 text-right text-sm">{{ $ticketStatuses[$key] ?? 0 }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @if(auth()->user()->role === 'user')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-4">Tiket Saya</h3>
                        @if($myTickets->count())
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2">Judul</th>
                                    <th class="text-left py-2">Status</th>
                                    <th class="text-left py-2">Priority</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myTickets as $ticket)
                                <tr class="border-b">
                                    <td class="py-2">
                                        <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:underline">{{ $ticket->title }}</a>
                                    </td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded
                                            @if($ticket->status === 'open') bg-yellow-100 text-yellow-800
                                            @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800
                                            @elseif($ticket->status === 'resolved') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">{{ str_replace('_', ' ', ucfirst($ticket->status)) }}</span>
                                    </td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded
                                            @if($ticket->priority === 'urgent') bg-red-100 text-red-800
                                            @elseif($ticket->priority === 'high') bg-orange-100 text-orange-800
                                            @elseif($ticket->priority === 'medium') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">{{ ucfirst($ticket->priority) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-gray-500">Belum ada tiket.</p>
                        @endif
                    </div>
                </div>
                @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-4">Tiket Terbaru</h3>
                        @if($recentTickets->count())
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2">Judul</th>
                                    <th class="text-left py-2">Pelapor</th>
                                    <th class="text-left py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTickets as $ticket)
                                <tr class="border-b">
                                    <td class="py-2"><a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:underline">{{ $ticket->title }}</a></td>
                                    <td class="py-2">{{ $ticket->user->name }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded
                                            @if($ticket->status === 'open') bg-yellow-100 text-yellow-800
                                            @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800
                                            @elseif($ticket->status === 'resolved') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">{{ str_replace('_', ' ', ucfirst($ticket->status)) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-gray-500">Belum ada tiket.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-4">Maintenance Terbaru</h3>
                        @if($recentLogs->count())
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2">Perangkat</th>
                                    <th class="text-left py-2">Teknisi</th>
                                    <th class="text-left py-2">Tipe</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentLogs as $log)
                                <tr class="border-b">
                                    <td class="py-2">{{ $log->device->name }}</td>
                                    <td class="py-2">{{ $log->user->name }}</td>
                                    <td class="py-2">{{ ucfirst($log->maintenance_type) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-gray-500">Belum ada log maintenance.</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
