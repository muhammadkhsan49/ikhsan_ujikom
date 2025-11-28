@extends('layouts.app')

@section('title', 'Notifikasi Saya')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4"><i class="bi bi-bell"></i> Notifikasi Saya</h2>
        </div>
    </div>

    @php
        $unreadCount = Auth::user()->notifications()->where('is_read', false)->count();
    @endphp

    @if ($unreadCount > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-info">
                    Anda memiliki <strong>{{ $unreadCount }}</strong> notifikasi baru
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            @forelse (Auth::user()->notifications()->latest()->paginate(10) as $notification)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <h5 class="mb-0">{{ $notification->title }}</h5>
                                    @if (!$notification->is_read)
                                        <span class="badge bg-primary">Baru</span>
                                    @endif
                                </div>
                                <p class="text-muted mb-2">{{ $notification->message }}</p>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="btn-group-vertical">
                                @if (!$notification->is_read)
                                    <form action="/notifications/{{ $notification->id }}/read" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-check"></i> Tandai Dibaca
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <h5>Tidak ada notifikasi</h5>
                    <p class="text-muted mb-0">Anda akan menerima notifikasi ketika admin memberikan update tentang pendaftaran Anda</p>
                </div>
            @endforelse

            {{ Auth::user()->notifications()->paginate(10)->links() }}
        </div>
    </div>
</div>
@endsection
