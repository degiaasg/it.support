<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $title }}</h2>
            <a href="{{ route('forms.pemeriksaan.create') }}" class="bg-gray-500 dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm dark:shadow-gray-900 sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('forms.pemeriksaan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kategori_asset" value="{{ $kategori }}">

                        <div class="text-center mb-8">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">FORMULIR PEMERIKSAAN PERANGKAT</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kategori }} - {{ $kategoriLabel }}</p>
                        </div>

                        {{-- Informasi Pengguna --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Informasi Pengguna</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama User</label>
                                    <input type="text" name="nama_user" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('nama_user') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIK User</label>
                                    <input type="text" name="nik_user" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('nik_user') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Department</label>
                                    <input type="text" name="department" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('department') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Site / B. Unit</label>
                                    <input type="text" name="site" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('site') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
                                    <input type="text" name="no_telepon" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('no_telepon') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat Email</label>
                                    <input type="email" name="email" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Perangkat --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Informasi Perangkat</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Brand</label>
                                    <input type="text" name="brand" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('brand') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe</label>
                                    <input type="text" name="tipe" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('tipe') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Perangkat</label>
                                    <input type="text" name="device_name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('device_name') }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Serial</label>
                                    <input type="text" name="no_serial" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('no_serial') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Asset</label>
                                    <input type="text" name="no_asset" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('no_asset') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                    <select name="status_baru_lama" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">
                                        <option value="">-- Pilih --</option>
                                        <option value="BARU" {{ old('status_baru_lama') === 'BARU' ? 'selected' : '' }}>BARU</option>
                                        <option value="LAMA" {{ old('status_baru_lama') === 'LAMA' ? 'selected' : '' }}>LAMA</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Pemeriksaan Hardware --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Pemeriksaan Hardware</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="text-left py-2 px-3 w-1/2">Komponen</th>
                                            <th class="text-center py-2 px-3">Kondisi (✓ = Baik / X = Tidak Baik)</th>
                                            <th class="text-left py-2 px-3">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $hardwareItems = ['Processor', 'Mainboard', 'Monitor/LCD', 'Casing', 'Camera', 'Port USB/Charger', 'Connectivity (LAN/WIFI)', 'Adaptor/PSU', 'Trackpad/Keyboard/Mouse', 'Audio (Speaker/Microphone)', 'Memory', 'Disk', 'Graphics Card', 'Battery'];
                                        @endphp
                                        @foreach($hardwareItems as $item)
                                        <tr class="border-b">
                                            <td class="py-2 px-3">{{ $item }}</td>
                                            <td class="py-2 px-3 text-center">
                                                <select name="hw_{{ Str::slug($item, '_') }}" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs">
                                                    <option value="">--</option>
                                                    <option value="BAIK">✓ Baik</option>
                                                    <option value="TIDAK_BAIK">X Tidak Baik</option>
                                                </select>
                                            </td>
                                            <td class="py-2 px-3">
                                                <input type="text" name="hw_{{ Str::slug($item, '_') }}_ket" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="border-b">
                                            <td class="py-2 px-3">
                                                <input type="text" name="hw_lainnya_nama" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Lainnya...">
                                            </td>
                                            <td class="py-2 px-3 text-center">
                                                <select name="hw_lainnya" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs">
                                                    <option value="">--</option>
                                                    <option value="BAIK">✓ Baik</option>
                                                    <option value="TIDAK_BAIK">X Tidak Baik</option>
                                                </select>
                                            </td>
                                            <td class="py-2 px-3">
                                                <input type="text" name="hw_lainnya_ket" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pemeriksaan Aplikasi --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Pemeriksaan Aplikasi</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Operating System</label>
                                    <input type="text" name="os_name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" placeholder="Nama OS" value="{{ old('os_name') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">&nbsp;</label>
                                    <select name="os_kondisi" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">
                                        <option value="">-- Kondisi OS --</option>
                                        <option value="BAIK">✓ Baik</option>
                                        <option value="TIDAK_BAIK">X Tidak Baik</option>
                                    </select>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="text-left py-2 px-3 w-1/2">Aplikasi</th>
                                            <th class="text-center py-2 px-3">Kondisi</th>
                                            <th class="text-left py-2 px-3">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $appItems = [
                                            'Nama Perangkat' => 'nama_perangkat',
                                            'User Account Profile' => 'user_account_profile',
                                            'Disk Capacity Usage' => 'disk_capacity_usage',
                                            'Kinerja Sistem' => 'kinerja_sistem',
                                            'Antivirus Kaspersky' => 'antivirus',
                                            'Manage Engine Desktop Central' => 'manage_engine',
                                            'Microsoft Office365' => 'office365',
                                            'OneDrive' => 'onedrive',
                                            'Microsoft Teams' => 'teams',
                                            'Adobe Reader' => 'adobe_reader',
                                            'Micro Edge' => 'micro_edge',
                                            'Anydesk' => 'anydesk',
                                            'Adobe Creative Photoshop' => 'adobe_creative',
                                        ];
                                        @endphp
                                        @foreach($appItems as $label => $field)
                                        <tr class="border-b">
                                            <td class="py-2 px-3">{{ $label }}</td>
                                            <td class="py-2 px-3 text-center">
                                                <select name="app_{{ $field }}" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs">
                                                    <option value="">--</option>
                                                    <option value="BAIK">✓ Baik</option>
                                                    <option value="TIDAK_BAIK">X Tidak Baik</option>
                                                </select>
                                            </td>
                                            <td class="py-2 px-3">
                                                <input type="text" name="app_{{ $field }}_ket" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="border-b">
                                            <td class="py-2 px-3">
                                                <input type="text" name="app_lainnya_nama" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Lainnya...">
                                            </td>
                                            <td class="py-2 px-3 text-center">
                                                <select name="app_lainnya" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs">
                                                    <option value="">--</option>
                                                    <option value="BAIK">✓ Baik</option>
                                                    <option value="TIDAK_BAIK">X Tidak Baik</option>
                                                </select>
                                            </td>
                                            <td class="py-2 px-3">
                                                <input type="text" name="app_lainnya_ket" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-xs" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Tindakan --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Tindakan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @php
                                $tindakanItems = [
                                    'marking' => 'Marking',
                                    'install_repair_reset_os' => 'Install / Repair / Reset OS',
                                    'create_delete_account' => 'Create / Delete Account',
                                    'delete_backup_data' => 'Delete / Backup Data',
                                    'install_uninstall_app' => 'Install / Uninstall Application',
                                    'service_sparepart' => 'Service / Pergantian Sparepart',
                                    'pergantian_unit' => 'Pergantian Unit (Replacement Unit)',
                                ];
                                @endphp
                                @foreach($tindakanItems as $field => $label)
                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                    <input type="checkbox" name="tindakan_{{ $field }}" value="1" {{ old('tindakan_'.$field) ? 'checked' : '' }} class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                                    {{ $label }}
                                </label>
                                @endforeach
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tindakan Lain</label>
                                <input type="text" name="tindakan_lain" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('tindakan_lain') }}">
                            </div>
                        </div>

                        {{-- Catatan & Hasil --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">Hasil Pemeriksaan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Pemeriksaan</label>
                                    <input type="date" name="tanggal_pemeriksaan" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('tanggal_pemeriksaan', date('Y-m-d')) }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pemeriksa</label>
                                    <input type="text" name="pemeriksa" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('pemeriksa', auth()->user()->name) }}" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan</label>
                                <textarea name="keterangan" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">{{ old('keterangan') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hasil Pemeriksaan</label>
                                <textarea name="hasil_pemeriksaan" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" placeholder="Kesimpulan hasil pemeriksaan...">{{ old('hasil_pemeriksaan') }}</textarea>
                            </div>
                        </div>

                        {{-- E-Sign --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 pb-2 border-b">E-Sign</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @php
                                    $signers = [
                                        'diperiksa' => 'Diperiksa Oleh',
                                        'diketahui' => 'Diketahui Oleh',
                                        'disetujui' => 'Disetujui Oleh',
                                    ];
                                @endphp
                                @foreach($signers as $key => $label)
                                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 text-center">{{ $label }}</p>
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Nama</label>
                                            <input type="text" name="esign_{{ $key }}_nama" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_'.$key.'_nama') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Jabatan</label>
                                            <input type="text" name="esign_{{ $key }}_jabatan" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_'.$key.'_jabatan') }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tanggal</label>
                                            <input type="date" name="esign_{{ $key }}_tanggal" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm" value="{{ old('esign_'.$key.'_tanggal', date('Y-m-d')) }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tanda Tangan</label>
                                            <div class="signature-pad relative border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden" style="touch-action: none;">
                                                <canvas class="sig-canvas w-full" height="120" style="cursor: crosshair; display: block; touch-action: none; background: #fff;"></canvas>
                                                <div class="absolute bottom-1 right-1 flex gap-1">
                                                    <button type="button" class="sig-upload-btn text-xs px-2 py-0.5 rounded bg-blue-100 hover:bg-blue-200 text-blue-700" data-key="{{ $key }}" title="Upload PNG">📁</button>
                                                    <button type="button" class="sig-clear-btn text-xs px-2 py-0.5 rounded bg-gray-200 hover:bg-gray-300 text-gray-600" data-key="{{ $key }}" title="Hapus">🗑</button>
                                                </div>
                                                <input type="file" accept="image/png" class="sig-file-input hidden" data-key="{{ $key }}">
                                                <input type="hidden" name="esign_{{ $key }}_signature" class="sig-hidden" data-key="{{ $key }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @push('scripts')
<script>
(function() {
    function initSignaturePad(key) {
        const container = document.querySelector(`.sig-hidden[data-key="${key}"]`).closest('.signature-pad');
        if (!container) return;
        const canvas = container.querySelector('.sig-canvas');
        const hiddenInput = container.querySelector('.sig-hidden');
        const fileInput = container.querySelector('.sig-file-input');
        const uploadBtn = container.querySelector('.sig-upload-btn');
        const clearBtn = container.querySelector('.sig-clear-btn');

        const ctx = canvas.getContext('2d');
        let drawing = false;
        let lastX = 0, lastY = 0;

        function resizeCanvas() {
            const rect = canvas.getBoundingClientRect();
            canvas.width = rect.width * (window.devicePixelRatio || 1);
            canvas.height = rect.height * (window.devicePixelRatio || 1);
            ctx.scale(window.devicePixelRatio || 1, window.devicePixelRatio || 1);
            ctx.strokeStyle = '#1e3a5f';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
        }

        function getPos(e) {
            const rect = canvas.getBoundingClientRect();
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            return { x: clientX - rect.left, y: clientY - rect.top };
        }

        function startDrawing(e) {
            e.preventDefault();
            drawing = true;
            const pos = getPos(e);
            lastX = pos.x;
            lastY = pos.y;
        }

        function draw(e) {
            e.preventDefault();
            if (!drawing) return;
            const pos = getPos(e);
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
            lastX = pos.x;
            lastY = pos.y;
        }

        function stopDrawing(e) {
            e.preventDefault();
            drawing = false;
            ctx.beginPath();
            updateHidden();
        }

        function updateHidden() {
            hiddenInput.value = canvas.toDataURL('image/png');
        }

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            hiddenInput.value = '';
        }

        function loadImageFile(file) {
            if (!file || !file.type.startsWith('image/png')) {
                alert('Hanya file PNG yang didukung.');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    const scale = Math.min(canvas.width / img.width, canvas.height / img.height) * (window.devicePixelRatio || 1);
                    const x = (canvas.width - img.width * scale) / 2;
                    const y = (canvas.height - img.height * scale) / 2;
                    ctx.drawImage(img, x, y, img.width * scale, img.height * scale);
                    updateHidden();
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        resizeCanvas();

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseleave', stopDrawing);
        canvas.addEventListener('touchstart', startDrawing, { passive: false });
        canvas.addEventListener('touchmove', draw, { passive: false });
        canvas.addEventListener('touchend', stopDrawing, { passive: false });

        clearBtn.addEventListener('click', clearCanvas);

        uploadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                loadImageFile(this.files[0]);
            }
        });

        window.addEventListener('resize', function() {
            const data = hiddenInput.value;
            resizeCanvas();
            if (data) {
                const img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, 0, 0);
                };
                img.src = data;
            }
        });
    }

    initSignaturePad('diperiksa');
    initSignaturePad('diketahui');
    initSignaturePad('disetujui');
})();
</script>
@endpush

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('forms.pemeriksaan.create') }}" class="px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">Batal</a>
                            <button type="submit" class="px-6 py-2 text-sm rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 font-medium">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
