@extends('layouts.app')

@section('title', 'Detail Verifikasi Pendaftar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <div class="p-3 border-bottom">
                    <h6 class="mb-0"><i class="bi bi-speedometer2"></i> Admin Panel</h6>
                </div>
                <ul class="sidebar-menu">
                    <li>
                        <a href="/admin">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/admin/verification" class="active">
                            <i class="bi bi-check-square"></i> Verifikasi Pendaftar
                        </a>
                    </li>
                    <li>
                        <a href="/admin/schedules">
                            <i class="bi bi-calendar"></i> Jadwal Seleksi
                        </a>
                    </li>
                    <li>
                        <a href="/admin/notifications">
                            <i class="bi bi-bell"></i> Notifikasi
                        </a>
                    </li>
                    <li>
                        <a href="/admin/export/excel">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </a>
                    </li>
                    <li>
                        <a href="/admin/export/pdf">
                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div class="main-content">
                <a href="/admin/verification" class="btn btn-secondary mb-3">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <h2 class="mb-4">{{ $registration->full_name }}</h2>

                <div class="row">
                    <div class="col-lg-8">
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
                                        <label class="form-label text-muted small">NIK</label>
                                        <p class="mb-0">{{ $registration->nik }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Jenis Kelamin</label>
                                        <p class="mb-0">{{ ucfirst($registration->gender) }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Tanggal Lahir</label>
                                        <p class="mb-0">{{ $registration->date_of_birth->format('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">No. Telepon</label>
                                        <p class="mb-0">{{ $registration->phone_number }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Email</label>
                                        <p class="mb-0">{{ $registration->email }}</p>
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
                                        <label class="form-label text-muted small">Sekolah/Universitas</label>
                                        <p class="mb-0">{{ $registration->school_name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Jurusan</label>
                                        <p class="mb-0">{{ $registration->major ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Tahun Lulus</label>
                                        <p class="mb-0">{{ $registration->graduation_year }}</p>
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
                                                        <i class="bi bi-download"></i> Lihat
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="col-lg-4">
                        <div class="card sticky-top" style="top: 20px;">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-tools"></i> Aksi Verifikasi</h5>
                            </div>
                            <div class="card-body">
                                @if ($registration->status === 'submitted')
                                    <!-- Verify Form -->
                                    <form action="/admin/verification/{{ $registration->id }}/verify" method="POST" class="mb-3">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Catatan Verifikasi (Opsional)</label>
                                            <textarea name="verification_notes" class="form-control" rows="3" 
                                                      placeholder="Masukkan catatan verifikasi..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success w-100 mb-2">
                                            <i class="bi bi-check-circle"></i> Terima
                                        </button>
                                    </form>

                                    <!-- Reject Modal -->
                                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                        <i class="bi bi-x-circle"></i> Tolak
                                    </button>

                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tolak Pendaftaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/admin/verification/{{ $registration->id }}/reject" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Alasan Penolakan *</label>
                                                            <textarea name="rejection_reason" class="form-control" rows="4" required
                                                                      placeholder="Jelaskan alasan penolakan..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Tolak Pendaftaran</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($registration->status === 'verified')
                                    <div class="alert alert-success">
                                        <i class="bi bi-check-circle"></i> Pendaftaran telah diverifikasi
                                    </div>
                                    <p class="small mb-2"><strong>Diverifikasi oleh:</strong> {{ $registration->verified_by }}</p>
                                    <p class="small mb-2"><strong>Tanggal:</strong> {{ $registration->verified_at->format('d F Y H:i') }}</p>
                                    @if ($registration->verification_notes)
                                        <p class="small"><strong>Catatan:</strong> {{ $registration->verification_notes }}</p>
                                    @endif
                                @elseif ($registration->status === 'rejected')
                                    <div class="alert alert-danger">
                                        <i class="bi bi-x-circle"></i> Pendaftaran ditolak
                                    </div>
                                    <p class="small"><strong>Alasan:</strong> {{ $registration->rejection_reason }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Status Card -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi</h5>
                            </div>
                            <div class="card-body">
                                <p class="small mb-2">
                                    <strong>No. Pendaftaran:</strong><br>
                                    {{ $registration->registration_number }}
                                </p>
                                <p class="small mb-2">
                                    <strong>Status:</strong><br>
                                    <span class="badge badge-status-{{ $registration->status }}">
                                        {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                                    </span>
                                </p>
                                <p class="small mb-0">
                                    <strong>Dibuat:</strong><br>
                                    {{ $registration->created_at->format('d F Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .sidebar {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        position: sticky;
        top: 20px;
    }
</style>
@endsection
