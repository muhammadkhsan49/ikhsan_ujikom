@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-clock-history"></i> Riwayat Pendaftaran</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Pendaftaran Anda</h5>
                    <a href="{{ route('registration.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Pendaftaran Baru
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No. Pendaftaran</th>
                                <th>Nama</th>
                                <th>Email</th>
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
                                    <td>{{ $registration->email }}</td>
                                    <td>
                                        <span class="badge badge-status-{{ $registration->status }}">
                                            {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $registration->created_at->format('d F Y') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('registration.show', $registration) }}" 
                                               class="btn btn-info" title="Lihat">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if (in_array($registration->status, ['draft', 'rejected']))
                                                <a href="{{ route('registration.edit', $registration) }}" 
                                                   class="btn btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('registration.destroy', $registration) }}" 
                                                      method="POST" style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($registration->status !== 'draft')
                                                <a href="{{ route('registration.pdf', $registration) }}" 
                                                   class="btn btn-success" title="Download PDF" target="_blank">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted mb-0">Anda belum memiliki pendaftaran</p>
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
@endsection
