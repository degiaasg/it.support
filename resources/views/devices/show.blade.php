<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $device->name }}</h2>
            <a href="{{ route('devices.edit', $device) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">Edit</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                        <h3 class="font-semibold text-lg mb-4">Informasi Perangkat</h3>
                        <table class="min-w-full text-sm">
                            <tr class="border-b">
                                <td class="py-2 font-medium w-40">Kategori</td>
                                <td class="py-2">{{ $device->category->name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Brand</td>
                                <td class="py-2">{{ $device->brand ?? '-' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Model</td>
                                <td class="py-2">{{ $device->model ?? '-' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Serial Number</td>
                                <td class="py-2">{{ $device->serial_number ?? '-' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Status</td>
                                <td class="py-2">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($device->status === 'available') bg-green-100 text-green-800
                                        @elseif($device->status === 'in_use') bg-blue-100 text-blue-800
                                        @elseif($device->status === 'under_maintenance') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">{{ str_replace('_', ' ', ucfirst($device->status)) }}</span>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Tanggal Pembelian</td>
                                <td class="py-2">{{ $device->purchase_date ? $device->purchase_date->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium">Garansi Hingga</td>
                                <td class="py-2">{{ $device->warranty_expiry ? $device->warranty_expiry->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium">Catatan</td>
                                <td class="py-2">{{ $device->notes ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                        <h3 class="font-semibold text-lg mb-4">Riwayat Maintenance</h3>
                        @if($device->maintenanceLogs->count())
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
                                @foreach($device->maintenanceLogs as $log)
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
                        <p class="text-gray-500">Belum ada riwayat maintenance.</p>
                        @endif
                    </div>
                </div>

                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 text-center">
                        <h3 class="font-semibold text-lg mb-4">QR Code</h3>
                        <img src="{{ route('devices.qr', $device) }}" alt="QR Code" class="inline-block">
                        <p class="text-xs text-gray-500 mt-2">{{ $device->name }}</p>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                        <h3 class="font-semibold text-lg mb-4">Tiket Terkait</h3>
                        @if($device->tickets->count())
                        <ul class="space-y-2">
                            @foreach($device->tickets as $ticket)
                            <li>
                                <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:underline text-sm">{{ $ticket->title }}</a>
                                <span class="px-1.5 py-0.5 text-xs rounded
                                    @if($ticket->status === 'open') bg-yellow-100 text-yellow-800
                                    @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($ticket->status === 'resolved') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">{{ ucfirst($ticket->status) }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p class="text-gray-500 text-sm">Belum ada tiket.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
