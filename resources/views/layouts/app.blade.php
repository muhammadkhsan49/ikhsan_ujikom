<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pendaftaran Brimob')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #fbbf24;
            --secondary: #f59e0b;
            --danger: #ef444444;
            --success: #22c55e;
            --white: #ffffff;
            --black: #000000;
            --light-gray: #f3f4f6;
            --dark-gray: #1f2937;
        }
        
        body {
            background-color: var(--white);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--black);
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--black) 0%, #1a1a1a 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            border-bottom: 3px solid var(--primary);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            color: white !important;
        }
        
        .navbar-brand i {
            color: var(--primary);
        }

        .nav-link {
            color: #d1d5db !important;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--black);
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
        }
        
        .btn-success {
            background-color: var(--success);
            border-color: var(--success);
            color: white;
        }
        
        .btn-danger {
            background-color: var(--danger);
            border-color: var(--danger);
            color: white;
        }
        
        .card {
            border: 2px solid var(--primary);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: var(--white);
            color: var(--black);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--black) 0%, var(--dark-gray) 100%);
            color: var(--primary);
            border-radius: 6px 6px 0 0;
            border: none;
            font-weight: 600;
            border-bottom: 3px solid var(--primary);
        }

        .card-body {
            background-color: var(--white);
        }

        .card-title {
            color: var(--black);
            font-weight: 600;
        }

        .card-text {
            color: var(--dark-gray);
        }
        
        .badge-status-draft {
            background-color: #9ca3af;
            color: white;
        }
        
        .badge-status-submitted {
            background-color: var(--primary);
            color: var(--black);
        }
        
        .badge-status-verified {
            background-color: var(--success);
            color: white;
        }
        
        .badge-status-rejected {
            background-color: var(--danger);
            color: white;
        }
        
        .sidebar {
            background: var(--white);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            min-height: 100vh;
            border-right: 3px solid var(--black);
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
        }
        
        .sidebar-menu li {
            padding: 0.5rem 0;
        }
        
        .sidebar-menu a {
            color: var(--black);
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            display: block;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: var(--primary);
            background-color: var(--light-gray);
            border-left-color: var(--primary);
            font-weight: 600;
        }
        
        .main-content {
            background-color: var(--light-gray);
            padding: 2rem;
        }
        
        .alert-dismissible .btn-close {
            padding: 0.5rem;
        }

        .alert-danger {
            background-color: #fee2e2;
            border-color: var(--danger);
            color: var(--black);
        }

        .alert-success {
            background-color: #dcfce7;
            border-color: var(--success);
            color: var(--black);
        }

        .table {
            color: var(--black);
            border-color: #e5e7eb;
        }

        .table thead {
            border-color: #e5e7eb;
        }

        .table thead th {
            background-color: var(--black);
            color: var(--primary);
            border-color: #e5e7eb;
        }

        .table tbody tr {
            border-color: #e5e7eb;
        }

        .table tbody tr:hover {
            background-color: var(--light-gray);
        }

        .form-control, .form-select {
            background-color: var(--white);
            border: 2px solid var(--black);
            color: var(--black);
        }

        .form-control:focus, .form-select:focus {
            background-color: var(--white);
            border-color: var(--primary);
            color: var(--black);
            box-shadow: 0 0 0 0.2rem rgba(251, 191, 36, 0.25);
        }

        .form-label {
            color: var(--black);
            font-weight: 600;
        }
        
        footer {
            background-color: var(--black) !important;
            border-top: 3px solid var(--primary) !important;
        }

        footer a {
            color: var(--primary);
        }

        footer a:hover {
            color: var(--secondary);
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .sidebar {
                margin-top: 1rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-shield-check"></i> Pendaftaran Brimob
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/notifications">
                                <i class="bi bi-bell"></i> Notifikasi
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @if ($errors->any())
        <div class="container-fluid mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5 class="alert-heading"><i class="bi bi-exclamation-circle"></i> Terjadi Kesalahan!</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="container-fluid mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container-fluid mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <div class="container-fluid">
        @yield('content')
    </div>

    <footer class="bg-light border-top mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-muted mb-0">
                        &copy; 2024 Sistem Pendaftaran Brimob. Semua hak cipta dilindungi.
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="text-muted mb-0">
                        Hubungi Admin: <a href="mailto:admin@brimob.go.id">admin@brimob.go.id</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
