<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Tiket</title>
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
    <h1>Laporan Tiket Maintenance</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Pelapor</th>
                <th>Perangkat</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Teknisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->user->name }}</td>
                <td>{{ $ticket->device->name }}</td>
                <td>{{ ucfirst($ticket->priority) }}</td>
                <td>{{ str_replace('_', ' ', ucfirst($ticket->status)) }}</td>
                <td>{{ $ticket->assignedTo->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">Dicetak pada {{ date('d/m/Y H:i') }}</div>
</body>
</html>
