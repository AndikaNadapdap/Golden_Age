<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paduan 1000 Hari - Panduan Tumbuh Kembang Anak</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #2E90FA;
            --secondary-color: #5CE1E6;
            --text-dark: #1e293b;
            --text-light: #64748b;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: var(--text-dark) !important;
        }

        .logo {
            width: 45px;
            height: 45px;
            background: var(--secondary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo i {
            color: white;
            font-size: 24px;
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            padding: 8px 24px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            border: none;
            font-weight: 600;
            padding: 8px 24px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 144, 250, 0.3);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #0EA5E9 0%, #06B6D4 100%);
            padding: 100px 0;
            color: white;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-section p {
            font-size: 20px;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .hero-image {
            max-width: 100%;
            height: auto;
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background: #f8fafc;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 36px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .section-title p {
            font-size: 18px;
            color: var(--text-light);
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #E3F5FF 0%, #BAE6FD 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .feature-icon i {
            font-size: 36px;
            color: var(--primary-color);
        }

        .feature-card h3 {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .feature-card .badge {
            font-size: 14px;
            padding: 6px 12px;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            padding: 80px 0;
            color: white;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .btn-light {
            background: white;
            color: var(--primary-color);
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            transition: all 0.3s;
        }

        .btn-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.3);
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: white;
            padding: 40px 0 20px;
        }

        .footer h5 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 10px;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 16px;
            border: none;
        }
        .modal-header {
            border-bottom: 1px solid #e2e8f0;
            padding: 24px;
        }
        .modal-body {
            padding: 24px;
        }
        .modal-footer {
            border-top: 1px solid #e2e8f0;
            padding: 20px 24px;
        }
        .feature-locked {
            cursor: pointer;
            position: relative;
        }
        .feature-locked:hover {
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 36px;
            }

            .hero-section p {
                font-size: 18px;
            }

            .section-title h2 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="logo">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <span>Paduan 1000 Hari</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recipes.index') }}">Resep</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('stimulations.index') }}">Stimulasi & Permainan</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(auth()->user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                                        </a>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person me-2"></i>Profile Saya</a></li>
                                    <li><a class="dropdown-item" href="{{ route('discussions.index') }}"><i class="bi bi-chat-dots me-2"></i>Forum Diskusi</a></li>
                                    @if(auth()->user()->role === 'parent')
                                        <li><a class="dropdown-item" href="{{ route('tracker.index') }}"><i class="bi bi-activity me-2"></i>Tracker Sensorik</a></li>
                                    @endif
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    @else
                        <li class="nav-item ms-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Masuk</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-primary">Daftar Gratis</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    @auth
                        <!-- Sambutan untuk user yang sudah login -->
                        <div class="mb-3">
                            <span class="badge bg-light text-primary px-3 py-2" style="font-size: 14px;">
                                <i class="bi bi-check-circle-fill me-1"></i>Selamat datang kembali!
                            </span>
                        </div>
                        <h1>Halo, {{ Auth::user()->name }}! 👋</h1>
                        <p>Senang melihat Anda kembali. Jelajahi berbagai fitur untuk mendampingi tumbuh kembang si kecil.</p>
                                               <div class="d-flex gap-3 flex-wrap">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-lg">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                                </a>
                            @elseif(auth()->user()->role === 'doctor')
                                <a href="{{ route('discussions.index') }}" class="btn btn-light btn-lg">
                                    <i class="bi bi-chat-dots me-2"></i>Akses Forum Diskusi
                                </a>
                            @elseif(auth()->user()->role === 'parent')
                                <a href="{{ route('articles.index') }}" class="btn btn-light btn-lg">
                                    <i class="bi bi-journal-text me-2"></i>Baca Artikel
                                </a>
                                <a href="{{ route('tracker.index') }}" class="btn btn-outline-light btn-lg">
                                    <i class="bi bi-activity me-2"></i>Tracker Sensorik
                                </a>
                            @endif
                        </div>
                    @else
                        <!-- Konten untuk guest/belum login -->
                        <h1>Dampingi 1000 Hari Pertama Si Kecil</h1>
                        <p>Platform lengkap untuk memantau tumbuh kembang anak Anda dari masa kehamilan hingga usia 2 tahun dengan panduan dari ahli.</p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-person-plus me-2"></i>Mulai Sekarang
                            </a>
                            <a href="#fitur" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-play-circle me-2"></i>Pelajari Lebih Lanjut
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="text-center">
                        <i class="bi bi-heart-pulse-fill" style="font-size: 200px; opacity: 0.9;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="fitur">
        <div class="container">
            <div class="section-title">
                <h2>Fitur Unggulan</h2>
                <p>Semua yang Anda butuhkan untuk mendampingi tumbuh kembang si kecil</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('articles.index') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="feature-icon" style="background: linear-gradient(135deg, #FCE7F3 0%, #FBCFE8 100%);">
                                <i class="bi bi-journal-text" style="color: #EC4899;"></i>
                            </div>
                            <h3>Artikel 1000 PHK</h3>
                            <p>Akses artikel lengkap tentang 1000 Hari Pertama Kehidupan anak dari para ahli.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('recipes.index') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="feature-icon" style="background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);">
                                <i class="bi bi-egg-fried" style="color: #F59E0B;"></i>
                            </div>
                            <h3>Resep MPASI</h3>
                            <p>Kumpulan resep MPASI sehat dan bergizi untuk si kecil mulai usia 6 bulan.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('stimulations.index') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="feature-icon" style="background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);">
                                <i class="bi bi-puzzle" style="color: #3B82F6;"></i>
                            </div>
                            <h3>Stimulasi & Permainan</h3>
                            <p>Panduan stimulasi dan permainan edukatif untuk perkembangan optimal anak.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('tracker.index') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="feature-icon" style="background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 100%);">
                                <i class="bi bi-activity" style="color: #0EA5E9;"></i>
                            </div>
                            <h3>Tracker Sensorik</h3>
                            <p>Pantau perkembangan sensorik dan motorik anak sesuai milestone usianya.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('discussions.index') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="feature-icon" style="background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);">
                                <i class="bi bi-chat-square-text" style="color: #10B981;"></i>
                            </div>
                            <h3>Forum Diskusi</h3>
                            <p>Bergabung dengan komunitas orang tua untuk berbagi pengalaman dan tips.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="kontak">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="logo">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <h5 class="mb-0">Paduan 1000 Hari</h5>
                    </div>
                    <p>Platform terpercaya untuk mendampingi 1000 hari pertama kehidupan buah hati Anda.</p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Navigasi</h5>
                    <ul>
                        <li><a href="#fitur">Fitur</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="{{ route('login') }}">Masuk</a></li>
                        <li><a href="{{ route('register') }}">Daftar</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Bantuan</h5>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Panduan</a></li>
                        <li><a href="#">Dukungan</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                    <h5>Ikuti Kami</h5>
                    <div class="d-flex gap-3">
                        <a href="#"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#"><i class="bi bi-youtube fs-4"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>
                    &copy; 2025 Paduan 1000 Hari. All rights reserved. |
                    <a href="/privacy-policy" target="_blank">Privacy and Policy</a> |
                    Contact: <a href="https://wa.me/6282167114827" target="_blank">+62 821-6711-4827</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="loginModalLabel">
                        <i class="bi bi-lock-fill me-2" style="color: var(--primary-color);"></i>Login Diperlukan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-4">
                        <i class="bi bi-shield-lock" style="font-size: 64px; color: var(--primary-color);"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Login Diperlukan</h5>
                    <p class="text-muted mb-4">Silakan login terlebih dahulu untuk mengakses fitur <span id="featureName" class="fw-bold text-primary"></span>.</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">
                            <i class="bi bi-person-plus me-2"></i>Daftar Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update modal content based on clicked feature
        const loginModal = document.getElementById('loginModal');
        if (loginModal) {
            loginModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const featureName = button.getAttribute('data-feature');
                const featureNameSpan = loginModal.querySelector('#featureName');
                featureNameSpan.textContent = featureName;
            });
        }
    </script>
</body>
</html>
