@extends('layouts.app')

@section('title', 'Jadwal Seleksi')

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
                        <a href="/admin/schedules" class="active">
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
                    <h2><i class="bi bi-calendar"></i> Jadwal Seleksi</h2>
                    <a href="/admin/schedules/create" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Jadwal
                    </a>
                </div>

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Tahap</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $schedule)
                                    <tr>
                                        <td><strong>{{ $schedule->title }}</strong></td>
                                        <td><span class="badge bg-primary">{{ $schedule->getStageLabel() }}</span></td>
                                        <td>{{ $schedule->start_date->format('d F Y H:i') }}</td>
                                        <td>{{ $schedule->end_date->format('d F Y H:i') }}</td>
                                        <td>{{ $schedule->location }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="/admin/schedules/{{ $schedule->id }}/edit" class="btn btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="/admin/schedules/{{ $schedule->id }}" method="POST" style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            Tidak ada jadwal seleksi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($schedules->hasPages())
                        <div class="card-footer">
                            {{ $schedules->links() }}
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
