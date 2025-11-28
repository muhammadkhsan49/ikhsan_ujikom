@extends('layouts.app')

@section('title', 'Verifikasi Pendaftar')

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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-check-square"></i> Verifikasi Pendaftar</h2>
                </div>

                <!-- Filter -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Filter Status:</label>
                                <div class="btn-group" role="group">
                                    <a href="/admin/verification?status=all" 
                                       class="btn btn-sm {{ $status === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                                        Semua ({{ \App\Models\Registration::count() }})
                                    </a>
                                    <a href="/admin/verification?status=submitted" 
                                       class="btn btn-sm {{ $status === 'submitted' ? 'btn-warning' : 'btn-outline-warning' }}">
                                        Menunggu ({{ \App\Models\Registration::where('status', 'submitted')->count() }})
                                    </a>
                                    <a href="/admin/verification?status=verified" 
                                       class="btn btn-sm {{ $status === 'verified' ? 'btn-success' : 'btn-outline-success' }}">
                                        Terverifikasi ({{ \App\Models\Registration::where('status', 'verified')->count() }})
                                    </a>
                                    <a href="/admin/verification?status=rejected" 
                                       class="btn btn-sm {{ $status === 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">
                                        Ditolak ({{ \App\Models\Registration::where('status', 'rejected')->count() }})
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Tabel -->
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No. Pendaftaran</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($registrations as $registration)
                                    <tr>
                                        <td><strong>{{ $registration->registration_number }}</strong></td>
                                        <td>{{ $registration->full_name }}</td>
                                        <td>{{ $registration->nik }}</td>
                                        <td>
                                            <span class="badge badge-status-{{ $registration->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $registration->created_at->format('d F Y') }}</td>
                                        <td>
                                            <a href="/admin/verification/{{ $registration->id }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            Tidak ada data pendaftar
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($registrations->hasPages())
                        <div class="card-footer">
                            {{ $registrations->links() }}
                        </div>
                    @endif
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
