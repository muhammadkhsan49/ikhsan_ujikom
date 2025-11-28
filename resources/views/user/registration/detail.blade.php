@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="bi bi-file-earmark"></i> Detail Pendaftaran</h2>
                <div>
                    @if ($registration->status !== 'draft')
                        <a href="{{ route('registration.pdf', $registration) }}" class="btn btn-success" target="_blank">
                            <i class="bi bi-download"></i> Download PDF
                        </a>
                    @endif
                    <a href="{{ route('registration.history') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Status -->
            <div class="alert alert-info mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <strong>No. Pendaftaran:</strong> {{ $registration->registration_number }}
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Status:</strong>
                        <span class="badge badge-status-{{ $registration->status }}">
                            {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                        </span>
                    </div>
                </div>
            </div>

            @if ($registration->isRejected())
                <div class="alert alert-danger mb-4">
                    <h6><i class="bi bi-exclamation-triangle"></i> Alasan Penolakan</h6>
                    <p class="mb-0">{{ $registration->rejection_reason }}</p>
                </div>
            @elseif ($registration->isVerified())
                <div class="alert alert-success mb-4">
                    <h6><i class="bi bi-check-circle"></i> Pendaftaran Terverifikasi</h6>
                    <p class="mb-2">Tanggal Verifikasi: {{ $registration->verified_at->format('d F Y H:i') }}</p>
                    <p class="mb-0">Diverifikasi oleh: {{ $registration->verified_by }}</p>
                    @if ($registration->verification_notes)
                        <hr>
                        <p class="mb-0"><strong>Catatan:</strong> {{ $registration->verification_notes }}</p>
                    @endif
                </div>
            @endif

            <!-- Data Diri -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-person"></i> Data Diri</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Nama Lengkap</label>
                            <p class="mb-0">{{ $registration->full_name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Jenis Kelamin</label>
                            <p class="mb-0">{{ ucfirst($registration->gender) }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Tempat Lahir</label>
                            <p class="mb-0">{{ $registration->place_of_birth }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Tanggal Lahir</label>
                            <p class="mb-0">{{ $registration->date_of_birth->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">NIK</label>
                            <p class="mb-0">{{ $registration->nik }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">No. Telepon</label>
                            <p class="mb-0">{{ $registration->phone_number }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label text-muted small">Email</label>
                            <p class="mb-0">{{ $registration->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Alamat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label text-muted small">Alamat Jalan</label>
                            <p class="mb-0">{{ $registration->street_address }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Desa/Kelurahan</label>
                            <p class="mb-0">{{ $registration->village }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Kecamatan</label>
                            <p class="mb-0">{{ $registration->district }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Kabupaten/Kota</label>
                            <p class="mb-0">{{ $registration->regency }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Provinsi</label>
                            <p class="mb-0">{{ $registration->province }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label text-muted small">Kode Pos</label>
                            <p class="mb-0">{{ $registration->postal_code }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendidikan -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-book"></i> Pendidikan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Tingkat Pendidikan</label>
                            <p class="mb-0">{{ $registration->education_level }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Tahun Lulus</label>
                            <p class="mb-0">{{ $registration->graduation_year }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Nama Sekolah/Universitas</label>
                            <p class="mb-0">{{ $registration->school_name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Jurusan/Program Studi</label>
                            <p class="mb-0">{{ $registration->major ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Fisik -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-person-check"></i> Data Fisik</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Tinggi Badan</label>
                            <p class="mb-0">{{ $registration->height }} cm</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Berat Badan</label>
                            <p class="mb-0">{{ $registration->weight }} kg</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kontak Darurat -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-telephone"></i> Kontak Darurat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label text-muted small">Nama Kontak</label>
                            <p class="mb-0">{{ $registration->emergency_contact_name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Hubungan</label>
                            <p class="mb-0">{{ $registration->emergency_contact_relationship }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">No. Telepon</label>
                            <p class="mb-0">{{ $registration->emergency_contact_phone }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dokumen -->
            @if ($registration->documents->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-file-pdf"></i> Dokumen</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($registration->documents as $document)
                                <div class="col-md-6 mb-3">
                                    <div class="border rounded p-3">
                                        <p class="small mb-2">
                                            <i class="bi bi-file"></i> {{ $document->getDocumentTypeLabel() }}
                                        </p>
                                        <p class="small text-muted mb-2">{{ $document->original_filename }}</p>
                                        <a href="{{ asset('storage/' . $document->file_path) }}" 
                                           target="_blank" class="btn btn-sm btn-primary">
                                            <i class="bi bi-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <p class="small"><strong>Dibuat pada:</strong></p>
                    <p class="small text-muted mb-3">{{ $registration->created_at->format('d F Y H:i') }}</p>

                    @if ($registration->status !== 'draft')
                        <p class="small"><strong>Diperbarui pada:</strong></p>
                        <p class="small text-muted mb-3">{{ $registration->updated_at->format('d F Y H:i') }}</p>
                    @endif

                    @if ($registration->isVerified())
                        <p class="small"><strong>Diverifikasi pada:</strong></p>
                        <p class="small text-muted mb-0">{{ $registration->verified_at->format('d F Y H:i') }}</p>
                    @endif

                    @if (in_array($registration->status, ['draft', 'rejected']))
                        <hr>
                        <a href="{{ route('registration.edit', $registration) }}" class="btn btn-warning w-100">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
