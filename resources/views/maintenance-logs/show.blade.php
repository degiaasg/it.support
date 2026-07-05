<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Detail Maintenance Log') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg p-6">
                <table class="min-w-full text-sm">
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 font-medium w-40">Tanggal</td>
                        <td class="py-2">{{ $maintenanceLog->performed_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 font-medium">Perangkat</td>
                            <td class="py-2"><a href="{{ route('devices.show', $maintenanceLog->device) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $maintenanceLog->device->name }}</a></td>
                    </tr>
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 font-medium">Tipe</td>
                        <td class="py-2">{{ ucfirst($maintenanceLog->maintenance_type) }}</td>
                    </tr>
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 font-medium">Teknisi</td>
                        <td class="py-2">{{ $maintenanceLog->user->name }}</td>
                    </tr>
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 font-medium">Tiket Terkait</td>
                        <td class="py-2">
                            @if($maintenanceLog->ticket)
                            <a href="{{ route('tickets.show', $maintenanceLog->ticket) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $maintenanceLog->ticket->title }}</a>
                            @else -
                            @endif
                        </td>
                    </tr>
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 font-medium">Deskripsi</td>
                        <td class="py-2">{{ $maintenanceLog->description }}</td>
                    </tr>
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 font-medium">Biaya</td>
                        <td class="py-2">Rp {{ number_format($maintenanceLog->cost, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium">Spare Parts</td>
                        <td class="py-2">
                            @if($maintenanceLog->spareParts->count())
                            <ul class="list-disc list-inside">
                                @foreach($maintenanceLog->spareParts as $part)
                                <li>{{ $part->name }} ({{ $part->pivot->quantity_used }} pcs) - Rp {{ number_format($part->unit_price * $part->pivot->quantity_used, 0, ',', '.') }}</li>
                                @endforeach
                            </ul>
                            @else -
                            @endif
                        </td>
                    </tr>
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 font-medium">File Evidence</td>
                        <td class="py-2">View</td>
                    </tr>
                </table>
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('maintenance-logs.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-gray-200 font-bold py-2 px-4 rounded text-sm">Kembali</a>
                    <a href="{{ route('maintenance-logs.edit', $maintenanceLog) }}" class="bg-blue-500 hover:bg-blue-700 text-white dark:bg-blue-600 dark:hover:bg-blue-500 font-bold py-2 px-4 rounded text-sm">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
