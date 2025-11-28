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
                --primary-color: #000000;
                --secondary-color: #1a1a1a;
                --accent-color: #404040;
                --success-color: #10b981;
                --danger-color: #ef4444;
                --text-light: #e5e7eb;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
                min-height: 100vh;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: var(--text-light);
            }

            /* Navbar */
            .navbar {
                background-color: rgba(26, 26, 26, 0.98) !important;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.5);
                border-bottom: 1px solid #404040;
            }

            .navbar-brand {
                font-weight: 700;
                color: #ffffff !important;
                font-size: 1.5rem;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .navbar-brand i {
                font-size: 2rem;
                color: #fbbf24;
            }

            .navbar-nav .nav-link {
                color: #d1d5db !important;
                margin-left: 20px;
                font-weight: 500;
                transition: color 0.3s ease;
            }

            .navbar-nav .nav-link:hover {
                color: #fbbf24 !important;
            }

            .btn-login {
                color: #fbbf24;
                border: 2px solid #fbbf24;
                font-weight: 600;
                margin-left: 10px;
                transition: all 0.3s ease;
            }

            .btn-login:hover {
                background-color: #fbbf24;
                color: #000;
            }

            .btn-register {
                background-color: #fbbf24;
                color: #000;
                font-weight: 600;
                margin-left: 10px;
                transition: all 0.3s ease;
            }

            .btn-register:hover {
                background-color: #f59e0b;
            }

            /* Hero Section */
            .hero-section {
                padding: 100px 0;
                color: white;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: calc(100vh - 70px);
                background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0f0f0f 100%);
            }

            .hero-content h1 {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
                line-height: 1.2;
                color: #ffffff;
            }

            .hero-content p {
                font-size: 1.3rem;
                margin-bottom: 2rem;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
                color: #d1d5db;
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
                background-color: #fbbf24;
                color: #000;
                border: 2px solid #fbbf24;
            }

            .btn-hero-white:hover {
                background-color: transparent;
                color: #fbbf24;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(251, 191, 36, 0.3);
            }

            .btn-hero-outline {
                background-color: transparent;
                color: #fbbf24;
                border: 2px solid #fbbf24;
            }

            .btn-hero-outline:hover {
                background-color: #fbbf24;
                color: #000;
                transform: translateY(-2px);
            }

            /* Features Section */
            .features-section {
                padding: 80px 0;
                background-color: #0f0f0f;
                border-top: 1px solid #404040;
            }

            .section-title {
                text-align: center;
                margin-bottom: 60px;
            }

            .section-title h2 {
                font-size: 2.5rem;
                font-weight: 700;
                color: #fbbf24;
                margin-bottom: 15px;
            }

            .section-title p {
                font-size: 1.1rem;
                color: #9ca3af;
            }

            .feature-card {
                text-align: center;
                padding: 40px 30px;
                border-radius: 10px;
                transition: all 0.3s ease;
                border: 1px solid #404040;
                height: 100%;
                background-color: #1a1a1a;
            }

            .feature-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 35px rgba(251, 191, 36, 0.1);
                border-color: #fbbf24;
                background-color: #262626;
            }

            .feature-icon {
                font-size: 3rem;
                color: #fbbf24;
                margin-bottom: 20px;
            }

            .feature-card h5 {
                color: #fbbf24;
                font-weight: 600;
                margin-bottom: 15px;
                font-size: 1.3rem;
            }

            .feature-card p {
                color: #d1d5db;
                line-height: 1.6;
                font-size: 0.95rem;
            }

            /* Stats Section */
            .stats-section {
                padding: 80px 0;
                background-color: #1a1a1a;
                border-top: 1px solid #404040;
            }

            .stat-item {
                text-align: center;
                margin-bottom: 40px;
            }

            .stat-number {
                font-size: 2.8rem;
                font-weight: 700;
                color: #fbbf24;
            }

            .stat-label {
                color: #9ca3af;
                font-size: 1.1rem;
                margin-top: 10px;
            }

            /* CTA Section */
            .cta-section {
                padding: 80px 0;
                background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
                color: white;
                text-align: center;
                border-top: 1px solid #404040;
            }

            .cta-section h2 {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                color: #fbbf24;
            }

            .cta-section p {
                font-size: 1.2rem;
                margin-bottom: 2rem;
                color: #d1d5db;
            }

            /* Footer */
            .footer {
                background-color: #000000;
                color: #9ca3af;
                padding: 40px 0 20px;
                text-align: center;
                margin-top: 80px;
                border-top: 1px solid #404040;
            }

            .footer p {
                margin-bottom: 10px;
                color: #d1d5db;
            }

            .footer-links {
                margin-bottom: 20px;
            }

            .footer-links a {
                color: #9ca3af;
                margin: 0 15px;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .footer-links a:hover {
                color: #fbbf24;
            }

            .footer-bottom {
                border-top: 1px solid #404040;
                padding-top: 20px;
                margin-top: 20px;
                color: #6b7280;
            }

            /* Responsive */
            @media (max-width: 768px) {
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
        <nav class="navbar navbar-expand-lg navbar-light">
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
