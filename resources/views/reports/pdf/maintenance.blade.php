<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Maintenance</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
        h1 { font-size: 18px; text-align: center; }
        .total { text-align: right; font-size: 14px; font-weight: bold; margin-top: 10px; }
        .footer { text-align: center; margin-top: 20px; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <h1>Laporan Maintenance</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Perangkat</th>
                <th>Tipe</th>
                <th>Deskripsi</th>
                <th>Teknisi</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->performed_at->format('d/m/Y') }}</td>
                <td>{{ $log->device->name }}</td>
                <td>{{ ucfirst($log->maintenance_type) }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->user->name }}</td>
                <td>Rp {{ number_format($log->cost, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">Total Biaya: Rp {{ number_format($totalCost, 0, ',', '.') }}</div>
    <div class="footer">Dicetak pada {{ date('d/m/Y H:i') }}</div>
</body>
</html>
