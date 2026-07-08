<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop']) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Preview Import CSV</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Ringkasan File</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <span class="text-blue-600 dark:text-blue-400 font-medium">Total Kolom</span>
                                <p class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ count($csvColumns) }}</p>
                            </div>
                            <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                <span class="text-green-600 dark:text-green-400 font-medium">Total Baris Data</span>
                                <p class="text-2xl font-bold text-green-700 dark:text-green-300">{{ $rowCount }}</p>
                            </div>
                        </div>
                    </div>

                    @if(!empty($missingRequired))
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                        <h4 class="font-semibold text-red-700 dark:text-red-400 mb-2">Kolom Wajib Tidak Ditemukan</h4>
                        <p class="text-sm text-red-600 dark:text-red-400 mb-2">Kolom berikut wajib ada di CSV tetapi tidak ditemukan. Import akan gagal untuk baris yang tidak memiliki data ini:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($missingRequired as $col)
                            <span class="px-2 py-1 bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-300 rounded text-xs font-mono">{{ $col }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Daftar Kolom Terdeteksi</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b">
                                        <th class="text-left py-2 px-3 w-8">#</th>
                                        <th class="text-left py-2 px-3">Nama Kolom</th>
                                        <th class="text-center py-2 px-3">Data Terisi</th>
                                        <th class="text-center py-2 px-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($csvColumns as $i => $col)
                                    @php
                                    $pct = $rowCount > 0 ? round($col['filled'] / $rowCount * 100) : 0;
                                    @endphp
                                    <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="py-2 px-3 text-gray-400">{{ $i + 1 }}</td>
                                        <td class="py-2 px-3 font-mono text-xs">{{ $col['name'] }}</td>
                                        <td class="py-2 px-3 text-center">
                                            <span class="text-xs {{ $col['filled'] == $rowCount ? 'text-green-600 dark:text-green-400' : ($col['filled'] > 0 ? 'text-yellow-600 dark:text-yellow-400' : 'text-red-600 dark:text-red-400') }}">
                                                {{ $col['filled'] }}/{{ $rowCount }}
                                                ({{ $pct }}%)
                                            </span>
                                            @if($col['filled'] < $rowCount)
                                            <div class="w-16 h-1.5 bg-gray-200 dark:bg-gray-600 rounded-full mx-auto mt-1">
                                                <div class="h-1.5 rounded-full {{ $col['filled'] == 0 ? 'bg-red-500' : 'bg-yellow-500' }}" style="width: {{ $pct }}%"></div>
                                            </div>
                                            @endif
                                        </td>
                                        <td class="py-2 px-3 text-center">
                                            @if($col['auto_set'])
                                            <span class="px-2 py-0.5 text-xs rounded bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300" title="Diisi otomatis oleh sistem">AUTO</span>
                                            @elseif($col['recognized'])
                                            <span class="px-2 py-0.5 text-xs rounded bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300">TERSEDIA</span>
                                            @else
                                            <span class="px-2 py-0.5 text-xs rounded bg-yellow-100 dark:bg-yellow-900/50 text-yellow-700 dark:text-yellow-300">TIDAK DIKENAL</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(!empty($missingRequired))
                    <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                            <div>
                                <p class="text-sm text-yellow-700 dark:text-yellow-400 font-medium">Beberapa kolom wajib belum tersedia di CSV.</p>
                                <p class="text-xs text-yellow-600 dark:text-yellow-500 mt-1">Data tetap dapat diimpor tetapi baris tanpa kolom wajib akan dilewati (gagal).</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="flex justify-between items-center pt-4 border-t">
                        <a href="{{ route('assets.item', ['slug' => 'computing-devices', 'item' => 'laptop']) }}" class="px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">Batal</a>
                        <form action="{{ route('assets.compd-lapt.import') }}" method="POST">
                            @csrf
                            <input type="hidden" name="temp_path" value="{{ $tempPath }}">
                            <button type="submit" class="px-6 py-2 text-sm rounded-lg bg-green-600 text-white hover:bg-green-700 font-medium flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Konfirmasi Import ({{ $rowCount }} data)
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
