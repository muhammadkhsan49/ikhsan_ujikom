<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pendaftaran Brimob - Registrasi Calon Anggota</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">

        <style>
            :root {
                --primary: #fbbf24;
                --secondary: #f59e0b;
                --black: #000000;
                --white: #ffffff;
                --danger: #ef4444;
                --success: #22c55e;
                --gray: #f3f4f6;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                background: linear-gradient(135deg, var(--white) 0%, var(--gray) 100%);
                min-height: 100vh;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: var(--black);
            }

            /* Navbar */
            .navbar {
                background: linear-gradient(135deg, var(--black) 0%, #1a1a1a 100%) !important;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                border-bottom: 3px solid var(--primary);
            }

            .navbar-brand {
                font-weight: 700;
                color: var(--white) !important;
                font-size: 1.5rem;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .navbar-brand i {
                font-size: 2rem;
                color: var(--primary);
            }

            .navbar-nav .nav-link {
                color: #d1d5db !important;
                margin-left: 20px;
                font-weight: 500;
                transition: color 0.3s ease;
            }

            .navbar-nav .nav-link:hover {
                color: var(--primary) !important;
            }

            .btn-login {
                color: var(--primary);
                border: 2px solid var(--primary);
                font-weight: 600;
                margin-left: 10px;
                transition: all 0.3s ease;
            }

            .btn-login:hover {
                background-color: var(--primary);
                color: var(--black);
            }

            .btn-register {
                background-color: var(--primary);
                color: var(--black);
                font-weight: 600;
                margin-left: 10px;
                transition: all 0.3s ease;
            }

            .btn-register:hover {
                background-color: var(--secondary);
            }

            /* Hero Section */
            .hero-section {
                padding: 100px 0;
                color: var(--white);
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: calc(100vh - 70px);
                background-image: url('{{ asset("image/aas.jpeg") }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                position: relative;
            }

            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1;
            }

            .hero-content {
                position: relative;
                z-index: 2;
            }

            .hero-logo {
                position: absolute;
                top: 30px;
                right: 30px;
                z-index: 3;
                max-width: 120px;
                animation: fadeIn 0.8s ease-in;
            }

            .hero-logo img {
                max-width: 100%;
                height: auto;
                filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.5));
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            .hero-content h1 {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.9);
                line-height: 1.2;
                color: var(--white);
            }

            .hero-content p {
                font-size: 1.3rem;
                margin-bottom: 2rem;
                text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.9);
                color: var(--white);
            }

            .hero-buttons {
                margin-top: 2rem;
            }

            .btn-hero {
                padding: 12px 40px;
                font-weight: 600;
                border-radius: 5px;
                transition: all 0.3s ease;
                margin: 10px;
                font-size: 1.1rem;
            }

            .btn-hero-white {
                background-color: var(--primary);
                color: var(--black);
                border: 2px solid var(--primary);
            }

            .btn-hero-white:hover {
                background-color: transparent;
                color: var(--primary);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(251, 191, 36, 0.3);
            }

            .btn-hero-outline {
                background-color: transparent;
                color: var(--primary);
                border: 2px solid var(--primary);
            }

            .btn-hero-outline:hover {
                background-color: var(--primary);
                color: var(--black);
                transform: translateY(-2px);
            }

            /* Features Section */
            .features-section {
                padding: 80px 0;
                background-color: var(--white);
                border-top: 2px solid var(--black);
            }

            .section-title {
                text-align: center;
                margin-bottom: 60px;
            }

            .section-title h2 {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--black);
                margin-bottom: 15px;
            }

            .section-title p {
                font-size: 1.1rem;
                color: #6b7280;
            }

            .feature-card {
                text-align: center;
                padding: 40px 30px;
                border-radius: 10px;
                transition: all 0.3s ease;
                border: 2px solid var(--black);
                height: 100%;
                background-color: var(--white);
            }

            .feature-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
                border-color: var(--primary);
                background-color: var(--gray);
            }

            .feature-icon {
                font-size: 3rem;
                color: var(--primary);
                margin-bottom: 20px;
            }

            .feature-card h5 {
                color: var(--black);
                font-weight: 600;
                margin-bottom: 15px;
                font-size: 1.3rem;
            }

            .feature-card p {
                color: #4b5563;
                line-height: 1.6;
                font-size: 0.95rem;
            }

            /* Stats Section */
            .stats-section {
                padding: 80px 0;
                background-color: var(--gray);
                border-top: 2px solid var(--black);
            }

            .stat-item {
                text-align: center;
                margin-bottom: 40px;
            }

            .stat-number {
                font-size: 2.8rem;
                font-weight: 700;
                color: var(--primary);
            }

            .stat-label {
                color: #6b7280;
                font-size: 1.1rem;
                margin-top: 10px;
            }

            /* CTA Section */
            .cta-section {
                padding: 80px 0;
                background: linear-gradient(135deg, var(--black) 0%, #1a1a1a 100%);
                color: var(--white);
                text-align: center;
                border-top: 2px solid var(--primary);
            }

            .cta-section h2 {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                color: var(--primary);
            }

            .cta-section p {
                font-size: 1.2rem;
                margin-bottom: 2rem;
                color: #d1d5db;
            }

            /* Footer */
            .footer {
                background-color: var(--black);
                color: #9ca3af;
                padding: 40px 0 20px;
                text-align: center;
                margin-top: 80px;
                border-top: 3px solid var(--primary);
            }

            .footer p {
                margin-bottom: 10px;
                color: #d1d5db;
            }

            .footer-links {
                margin-bottom: 20px;
            }

            .footer-links a {
                color: var(--primary);
                margin: 0 15px;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .footer-links a:hover {
                color: var(--secondary);
            }

            .footer-bottom {
                border-top: 1px solid #333;
                padding-top: 20px;
                margin-top: 20px;
                color: #6b7280;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .hero-logo {
                    top: 20px;
                    right: 20px;
                    max-width: 80px;
                }

                .hero-content h1 {
                    font-size: 2.2rem;
                }

                .hero-content p {
                    font-size: 1.1rem;
                }

                .section-title h2 {
                    font-size: 2rem;
                }

                .stat-number {
                    font-size: 2rem;
                }

                .btn-hero {
                    display: block;
                    margin: 10px auto;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-shield-check"></i>
                    Brimob Pendaftaran
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#stats">Informasi</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link btn btn-login" href="{{ url('/dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-login" href="{{ route('login') }}">Masuk</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-register" href="{{ route('register') }}">Daftar</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-logo">
                <img src="{{ asset('image/aas2).png') }}" alt="Brimob Logo">
            </div>
            <div class="container">
                <div class="hero-content">
                    <h1>Sistem Pendaftaran Calon Anggota Brimob</h1>
                    <p>Platform resmi untuk mendaftar sebagai calon anggota Brigade Mobil (Brimob) Polri</p>
                    <div class="hero-buttons">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-hero btn-hero-white">
                                <i class="bi bi-speedometer2"></i> Ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-hero btn-hero-white">
                                <i class="bi bi-person-plus"></i> Daftar Sekarang
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-hero btn-hero-outline">
                                <i class="bi bi-box-arrow-in-right"></i> Masuk
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features-section">
            <div class="container">
                <div class="section-title">
                    <h2>Fitur Utama</h2>
                    <p>Kelengkapan sistem untuk memudahkan pendaftaran Anda</p>
                </div>

                <div class="row g-4">
                    <!-- Feature 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-form-check"></i>
                            </div>
                            <h5>Formulir Lengkap</h5>
                            <p>Isi formulir pendaftaran dengan data pribadi, alamat, pendidikan, kesehatan, dan dokumen pendukung</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </div>
                            <h5>Upload Dokumen</h5>
                            <p>Unggah dokumen pendukung seperti KTP, Ijazah, Foto Formal, dan Surat Kesehatan</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <h5>Riwayat Pendaftaran</h5>
                            <p>Lihat semua pendaftaran Anda dan status verifikasi secara real-time</p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <h5>Verifikasi Otomatis</h5>
                            <p>Sistem verifikasi admin untuk meninjau dan menyetujui pendaftaran Anda</p>
                        </div>
                    </div>

                    <!-- Feature 5 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-bell"></i>
                            </div>
                            <h5>Notifikasi Real-time</h5>
                            <p>Dapatkan notifikasi setiap ada update status pendaftaran dan jadwal seleksi</p>
                        </div>
                    </div>

                    <!-- Feature 6 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-printer"></i>
                            </div>
                            <h5>Cetak Sertifikat</h5>
                            <p>Unduh dan cetak sertifikat pendaftaran dalam format PDF setelah verifikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section id="stats" class="stats-section">
            <div class="container">
                <div class="section-title">
                    <h2>Statistik Pendaftaran</h2>
                    <p>Data real-time dari sistem kami</p>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-item">
                            <div class="stat-number">
                                <i class="bi bi-people-fill"></i> {{ \App\Models\User::where('role', 'user')->count() }}
                            </div>
                            <div class="stat-label">Peserta Terdaftar</div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="stat-item">
                            <div class="stat-number">
                                <i class="bi bi-file-earmark-check"></i> {{ \App\Models\Registration::where('status', 'submitted')->count() }}
                            </div>
                            <div class="stat-label">Menunggu Verifikasi</div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="stat-item">
                            <div class="stat-number">
                                <i class="bi bi-check-circle-fill"></i> {{ \App\Models\Registration::where('status', 'verified')->count() }}
                            </div>
                            <div class="stat-label">Terverifikasi</div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="stat-item">
                            <div class="stat-number">
                                <i class="bi bi-calendar2-check"></i> {{ \App\Models\SelectionSchedule::count() }}
                            </div>
                            <div class="stat-label">Total Jadwal</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <h2>Siap untuk Bergabung?</h2>
                <p>Mulai pendaftaran Anda sekarang dan jadilah bagian dari Brigade Mobil Polri</p>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-hero btn-hero-white">
                        <i class="bi bi-arrow-right-circle"></i> Lanjut ke Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-hero btn-hero-white">
                        <i class="bi bi-person-plus"></i> Daftar Sekarang
                    </a>
                @endauth
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <p>&copy; 2025 Sistem Pendaftaran Brimob Polri. Semua hak dilindungi.</p>
                <div class="footer-links">
                    <a href="#">Tentang Kami</a>
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat dan Ketentuan</a>
                    <a href="#">Hubungi Kami</a>
                </div>
                <div class="footer-bottom">
                    <p>Dikembangkan dengan <i class="bi bi-heart-fill text-danger"></i> untuk melayani Indonesia</p>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
