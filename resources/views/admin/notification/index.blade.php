@extends('layouts.app')

@section('title', 'Daftar Notifikasi')

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
                        <a href="/admin/notifications" class="active">
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
                <h2 class="mb-4"><i class="bi bi-bell"></i> Notifikasi Sistem</h2>

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Pesan</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notifications as $notification)
                                    <tr {{ !$notification->is_read ? 'style="background-color: #f0f7ff;"' : '' }}>
                                        <td>
                                            <strong>{{ $notification->title }}</strong>
                                        </td>
                                        <td>
                                            <small>{{ Str::limit($notification->message, 50) }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $notification->type === 'success' ? 'success' : ($notification->type === 'error' ? 'danger' : 'info') }}">
                                                {{ ucfirst($notification->type) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($notification->is_read)
                                                <span class="badge bg-secondary">Dibaca</span>
                                            @else
                                                <span class="badge bg-primary">Baru</span>
                                            @endif
                                        </td>
                                        <td>{{ $notification->created_at->format('d F Y H:i') }}</td>
                                        <td>
                                            <form action="/admin/notifications/{{ $notification->id }}" method="POST" style="display: inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Yakin ingin menghapus?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            Tidak ada notifikasi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($notifications->hasPages())
                        <div class="card-footer">
                            {{ $notifications->links() }}
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
