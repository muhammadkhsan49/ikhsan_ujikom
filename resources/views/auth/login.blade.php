@extends('layouts.app')

@section('title', 'Login - Pendaftaran Brimob')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-lock"></i> Login</h4>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                    </form>

                    <p class="text-center text-muted mb-0">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                    </p>
                </div>
            </div>

            <div class="mt-4 p-3 bg-light rounded">
                <h6><i class="bi bi-info-circle"></i> Demo Account</h6>
                <p class="small mb-1"><strong>User:</strong></p>
                <p class="small mb-2">Email: user@example.com | Password: password</p>
                <p class="small mb-1"><strong>Admin:</strong></p>
                <p class="small mb-0">Email: admin@example.com | Password: password</p>
            </div>
        </div>
    </div>
</div>
@endsection
