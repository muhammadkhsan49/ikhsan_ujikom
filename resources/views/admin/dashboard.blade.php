@extends('layouts.app')

@section('title', 'Admin Dashboard')

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
                        <a href="/admin" class="active">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/admin/verification">
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
                <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Admin</h2>

                <!-- Statistik -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Pendaftar</h6>
                                        <h3 class="mb-0">{{ $totalRegistrations }}</h3>
                                    </div>
                                    <i class="bi bi-people" style="font-size: 3rem; opacity: 0.3;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Menunggu Verifikasi</h6>
                                        <h3 class="mb-0" style="color: #f59e0b;">{{ $pendingVerification }}</h3>
                                    </div>
                                    <i class="bi bi-clock-history" style="font-size: 3rem; opacity: 0.3; color: #f59e0b;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Terverifikasi</h6>
                                        <h3 class="mb-0" style="color: #16a34a;">{{ $verifiedRegistrations }}</h3>
                                    </div>
                                    <i class="bi bi-check-circle" style="font-size: 3rem; opacity: 0.3; color: #16a34a;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Ditolak</h6>
                                        <h3 class="mb-0" style="color: #dc2626;">{{ $rejectedRegistrations }}</h3>
                                    </div>
                                    <i class="bi bi-x-circle" style="font-size: 3rem; opacity: 0.3; color: #dc2626;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pendaftaran Terbaru -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Pendaftaran Terbaru</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No. Pendaftaran</th>
                                    <th>Nama Pendaftar</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentRegistrations as $registration)
                                    <tr>
                                        <td><strong>{{ $registration->registration_number }}</strong></td>
                                        <td>{{ $registration->full_name }}</td>
                                        <td>
                                            <span class="badge badge-status-{{ $registration->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $registration->created_at->format('d F Y') }}</td>
                                        <td>
                                            <a href="/admin/verification/{{ $registration->id }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Notifikasi Terbaru -->
                @if ($recentNotifications->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Notifikasi Terbaru</h5>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @foreach ($recentNotifications as $notification)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $notification->title }}</h6>
                                                <p class="mb-1 small text-muted">{{ $notification->message }}</p>
                                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            @if (!$notification->is_read)
                                                <span class="badge bg-primary">Baru</span>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
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
