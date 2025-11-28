@extends('layouts.app')

@section('title', 'Dashboard - Pendaftaran Brimob')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4"><i class="bi bi-house-door"></i> Dashboard</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            @if ($activeSchedule)
                <div class="alert alert-info">
                    <i class="bi bi-calendar-event"></i>
                    <strong>Pendaftaran Terbuka!</strong> {{ $activeSchedule->title }}
                    <br>
                    <small class="text-muted">Berlaku hingga {{ $activeSchedule->end_date->format('d F Y H:i') }}</small>
                </div>
            @endif
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <a href="{{ route('registration.create') }}" class="btn btn-primary btn-lg w-100 h-100" style="padding: 2rem; text-decoration: none; color: white;">
                <div class="text-center">
                    <i class="bi bi-pencil-square" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                    <h5 class="mb-0">Buat Pendaftaran Baru</h5>
                    <small>Mulai isi formulir pendaftaran</small>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('registration.history') }}" class="btn btn-outline-primary btn-lg w-100 h-100" style="padding: 2rem; text-decoration: none;">
                <div class="text-center">
                    <i class="bi bi-clock-history" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                    <h5 class="mb-0">Riwayat Pendaftaran</h5>
                    <small>Lihat semua pendaftaran Anda</small>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/notifications" class="btn btn-outline-primary btn-lg w-100 h-100" style="padding: 2rem; text-decoration: none;">
                <div class="text-center">
                    <i class="bi bi-bell" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                    <h5 class="mb-0">Notifikasi</h5>
                    <small>Cek notifikasi terbaru</small>
                </div>
            </a>
        </div>
    </div>

    @if ($registrations->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Pendaftaran Terbaru</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No. Pendaftaran</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registrations as $registration)
                                    <tr>
                                        <td>
                                            <strong>{{ $registration->registration_number }}</strong>
                                        </td>
                                        <td>{{ $registration->full_name }}</td>
                                        <td>
                                            <span class="badge badge-status-{{ $registration->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $registration->created_at->format('d F Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('registration.show', $registration) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="bi bi-info-circle" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <h5>Anda belum memiliki pendaftaran</h5>
                    <p class="text-muted mb-0">Mulai pendaftaran Anda sekarang dengan mengklik tombol di atas</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
