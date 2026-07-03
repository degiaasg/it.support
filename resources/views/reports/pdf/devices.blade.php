<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Perangkat</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
        h1 { font-size: 18px; text-align: center; }
        .footer { text-align: center; margin-top: 20px; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <h1>Laporan Inventaris Perangkat</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Brand</th>
                <th>Serial Number</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $device)
            <tr>
                <td>{{ $device->name }}</td>
                <td>{{ $device->category->name }}</td>
                <td>{{ $device->brand ?? '-' }}</td>
                <td>{{ $device->serial_number ?? '-' }}</td>
                <td>{{ ucfirst($device->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">Dicetak pada {{ date('d/m/Y H:i') }}</div>
</body>
</html>
