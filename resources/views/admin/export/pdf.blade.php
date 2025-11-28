<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Pendaftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #1e40af;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            color: #1e40af;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table thead {
            background-color: #1e40af;
            color: white;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            font-size: 11px;
            border: 1px solid #ddd;
        }
        table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .footer {
            border-top: 1px solid #ccc;
            margin-top: 40px;
            padding-top: 20px;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA PENDAFTAR BRIMOB</h1>
        <p>Dicetak pada {{ now()->format('d F Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Pendaftaran</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Pendidikan</th>
                <th>Tinggi/Berat</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($registrations as $key => $registration)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $registration->registration_number }}</td>
                    <td>{{ $registration->full_name }}</td>
                    <td>{{ $registration->nik }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>{{ $registration->phone_number }}</td>
                    <td>{{ $registration->education_level }}</td>
                    <td>{{ $registration->height }} cm / {{ $registration->weight }} kg</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $registration->status)) }}</td>
                    <td>{{ $registration->created_at->format('d F Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Pendaftar: {{ $registrations->count() }} orang</p>
        <p>Sistem Pendaftaran Brimob © 2024 - Semua Hak Cipta Dilindungi</p>
    </div>
</body>
</html>
