<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran</title>
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
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            background-color: #1e40af;
            color: white;
            padding: 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .row {
            display: flex;
            margin-bottom: 10px;
        }
        .col {
            flex: 1;
            padding-right: 20px;
        }
        .label {
            font-weight: bold;
            color: #1e40af;
            font-size: 12px;
        }
        .value {
            font-size: 13px;
            margin-top: 3px;
        }
        .footer {
            border-top: 1px solid #ccc;
            margin-top: 40px;
            padding-top: 20px;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
        .badge {
            display: inline-block;
            padding: 5px 15px;
            background-color: #16a34a;
            color: white;
            border-radius: 3px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BUKTI PENDAFTARAN BRIMOB</h1>
        <p>Sistem Informasi Pendaftaran Polri</p>
        <p>Nomor Pendaftaran: <strong>{{ $registration->registration_number }}</strong></p>
    </div>

    <div class="section">
        <div class="section-title">STATUS PENDAFTARAN</div>
        <table>
            <tr>
                <td width="50%">
                    <div class="label">Status</div>
                    <div class="value">
                        <span class="badge">{{ strtoupper($registration->status) }}</span>
                    </div>
                </td>
                <td width="50%">
                    <div class="label">Tanggal Dibuat</div>
                    <div class="value">{{ $registration->created_at->format('d F Y H:i') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">DATA DIRI</div>
        <div class="row">
            <div class="col">
                <div class="label">Nama Lengkap</div>
                <div class="value">{{ $registration->full_name }}</div>
            </div>
            <div class="col">
                <div class="label">Jenis Kelamin</div>
                <div class="value">{{ ucfirst($registration->gender) }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="label">Tempat/Tanggal Lahir</div>
                <div class="value">{{ $registration->place_of_birth }}, {{ $registration->date_of_birth->format('d F Y') }}</div>
            </div>
            <div class="col">
                <div class="label">NIK</div>
                <div class="value">{{ $registration->nik }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="label">Email</div>
                <div class="value">{{ $registration->email }}</div>
            </div>
            <div class="col">
                <div class="label">No. Telepon</div>
                <div class="value">{{ $registration->phone_number }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">ALAMAT</div>
        <div class="row">
            <div class="col">
                <div class="label">Alamat Jalan</div>
                <div class="value">{{ $registration->street_address }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="label">Desa/Kelurahan</div>
                <div class="value">{{ $registration->village }}</div>
            </div>
            <div class="col">
                <div class="label">Kecamatan</div>
                <div class="value">{{ $registration->district }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="label">Kabupaten/Kota</div>
                <div class="value">{{ $registration->regency }}</div>
            </div>
            <div class="col">
                <div class="label">Provinsi</div>
                <div class="value">{{ $registration->province }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="label">Kode Pos</div>
                <div class="value">{{ $registration->postal_code }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">PENDIDIKAN</div>
        <div class="row">
            <div class="col">
                <div class="label">Tingkat Pendidikan</div>
                <div class="value">{{ $registration->education_level }}</div>
            </div>
            <div class="col">
                <div class="label">Tahun Lulus</div>
                <div class="value">{{ $registration->graduation_year }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="label">Nama Sekolah/Universitas</div>
                <div class="value">{{ $registration->school_name }}</div>
            </div>
            <div class="col">
                <div class="label">Jurusan</div>
                <div class="value">{{ $registration->major ?? '-' }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">DATA FISIK</div>
        <div class="row">
            <div class="col">
                <div class="label">Tinggi Badan</div>
                <div class="value">{{ $registration->height }} cm</div>
            </div>
            <div class="col">
                <div class="label">Berat Badan</div>
                <div class="value">{{ $registration->weight }} kg</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">KONTAK DARURAT</div>
        <div class="row">
            <div class="col">
                <div class="label">Nama Kontak</div>
                <div class="value">{{ $registration->emergency_contact_name }}</div>
            </div>
            <div class="col">
                <div class="label">Hubungan</div>
                <div class="value">{{ $registration->emergency_contact_relationship }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="label">No. Telepon</div>
                <div class="value">{{ $registration->emergency_contact_phone }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">DOKUMEN YANG TERUPLOAD</div>
        <table>
            <tr>
                <td><strong>Jenis Dokumen</strong></td>
                <td><strong>Nama File</strong></td>
                <td><strong>Status</strong></td>
            </tr>
            @foreach (['ktp', 'ijazah', 'foto_formal', 'surat_kesehatan'] as $type)
                @php
                    $doc = $registration->documents->where('document_type', $type)->first();
                @endphp
                <tr>
                    <td>
                        @if ($type === 'ktp') KTP
                        @elseif ($type === 'ijazah') Ijazah
                        @elseif ($type === 'foto_formal') Foto Formal
                        @elseif ($type === 'surat_kesehatan') Surat Kesehatan
                        @endif
                    </td>
                    <td>{{ $doc ? $doc->original_filename : '-' }}</td>
                    <td>{{ $doc ? '✓ Terupload' : '✗ Belum' }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    @if ($registration->isVerified())
        <div class="section">
            <div class="section-title">VERIFIKASI</div>
            <table>
                <tr>
                    <td width="50%">
                        <div class="label">Diverifikasi Oleh</div>
                        <div class="value">{{ $registration->verified_by }}</div>
                    </td>
                    <td width="50%">
                        <div class="label">Tanggal Verifikasi</div>
                        <div class="value">{{ $registration->verified_at->format('d F Y H:i') }}</div>
                    </td>
                </tr>
            </table>
            @if ($registration->verification_notes)
                <div style="margin-top: 15px;">
                    <div class="label">Catatan Verifikasi</div>
                    <div class="value">{{ $registration->verification_notes }}</div>
                </div>
            @endif
        </div>
    @elseif ($registration->isRejected())
        <div class="section">
            <div class="section-title">ALASAN PENOLAKAN</div>
            <div style="background-color: #fee; padding: 15px; border-radius: 5px;">
                <div class="value">{{ $registration->rejection_reason }}</div>
            </div>
        </div>
    @endif

    <div class="footer">
        <p>Dokumen ini dicetak pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>Sistem Pendaftaran Brimob © 2024 - Semua Hak Cipta Dilindungi</p>
    </div>
</body>
</html>
