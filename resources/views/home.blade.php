<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Panduan 1000 Hari</title>
    
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

        /* About Section */
        .about-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 100%);
        }

        .about-section h1 {
            font-size: 48px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 24px;
            line-height: 1.2;
        }

        .about-section .lead {
            font-size: 20px;
            color: var(--text-light);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .about-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .about-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #E3F5FF 0%, #BAE6FD 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .about-icon i {
            font-size: 28px;
            color: var(--primary-color);
        }

        .about-card h3 {
            font-size: 22px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .about-card p {
            color: var(--text-light);
            line-height: 1.7;
        }

        /* Mission Section */
        .mission-section {
            padding: 80px 0;
            background: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 36px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .section-title p {
            font-size: 18px;
            color: var(--text-light);
        }

        .mission-card {
            text-align: center;
            padding: 30px;
        }

        .mission-number {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: white;
            font-size: 32px;
            font-weight: 700;
        }

        .mission-card h4 {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .mission-card p {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            padding: 60px 0;
            color: white;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 16px;
            opacity: 0.9;
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

        @media (max-width: 768px) {
            .about-section h1 {
                font-size: 36px;
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
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="logo">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <span>Panduan 1000 Hari</span>
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

    <!-- About Section -->
    <section class="about-section" id="tentang">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    @auth
                        <div class="mb-4">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 mb-3">
                                <i class="bi bi-star-fill me-2"></i>Selamat Datang Kembali
                            </span>
                        </div>
                        <h1>Halo, {{ Auth::user()->name }}! 👋</h1>
                        <p class="lead">
                            @if(Auth::user()->isParent())
                                Senang bertemu Anda kembali! Mari terus pantau dan dukung tumbuh kembang si kecil bersama kami.
                            @elseif(Auth::user()->isDoctor())
                                Terima kasih telah bergabung sebagai dokter profesional dalam platform kami.
                            @else
                                Terima kasih telah bergabung dengan Panduan 1000 Hari.
                            @endif
                        </p>
                        
                        @if(Auth::user()->isParent())
                            @php
                                $childrenCount = Auth::user()->children()->count();
                            @endphp
                            @if($childrenCount > 0)
                                <div class="alert alert-info border-0 shadow-sm">
                                    <i class="bi bi-hearts me-2"></i>
                                    Anda memiliki <strong>{{ $childrenCount }}</strong> data anak yang terdaftar.
                                    <a href="{{ route('profile.index') }}" class="alert-link">Lihat Profile</a>
                                </div>
                            @else
                                <div class="alert alert-warning border-0 shadow-sm">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Anda belum menambahkan data anak. 
                                    <a href="{{ route('profile.index') }}" class="alert-link">Tambah Data Anak</a>
                                </div>
                            @endif
                        @endif

                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('profile.index') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-person me-2"></i>Profile Saya
                            </a>
                            <a href="{{ route('articles.index') }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-book me-2"></i>Jelajahi Artikel
                            </a>
                        </div>
                    @else
                        <h1>Tentang Panduan 1000 Hari</h1>
                        <p class="lead">Platform digital terpercaya untuk mendampingi orang tua dalam memantau dan mengoptimalkan tumbuh kembang anak pada 1000 hari pertama kehidupan.</p>
                        <p class="text-muted">
                            1000 Hari Pertama Kehidupan (HPK) adalah periode emas yang dimulai sejak masa kehamilan hingga anak berusia 2 tahun. Masa ini sangat krusial karena menentukan kualitas kesehatan, kecerdasan, dan produktivitas anak di masa depan.
                        </p>
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-person-plus me-2"></i>Bergabung Sekarang
                            </a>
                            <a href="{{ route('articles.index') }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-book me-2"></i>Baca Artikel
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="about-card">
                                <div class="about-icon">
                                    <i class="bi bi-lightbulb"></i>
                                </div>
                                <h3>Edukasi Berkualitas</h3>
                                <p>Artikel dan panduan dari para ahli kesehatan, nutrisi, dan perkembangan anak.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about-card">
                                <div class="about-icon">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <h3>Pantau Perkembangan</h3>
                                <p>Lacak pertumbuhan dan perkembangan anak dengan mudah dan akurat.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about-card">
                                <div class="about-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h3>Komunitas Aktif</h3>
                                <p>Bergabung dengan ribuan orang tua untuk berbagi pengalaman dan tips.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about-card">
                                <div class="about-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h3>Terpercaya</h3>
                                <p>Informasi terverifikasi dan sesuai dengan standar kesehatan nasional.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section" id="misi">
        <div class="container">
            <div class="section-title">
                <h2>Misi Kami</h2>
                <p>Komitmen kami untuk mendukung tumbuh kembang anak Indonesia</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="mission-card">
                        <div class="mission-number">1</div>
                        <h4>Meningkatkan Kesadaran</h4>
                        <p>Mengedukasi masyarakat tentang pentingnya 1000 hari pertama kehidupan untuk masa depan anak.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mission-card">
                        <div class="mission-number">2</div>
                        <h4>Memberikan Akses Mudah</h4>
                        <p>Menyediakan platform yang mudah diakses untuk informasi dan panduan tumbuh kembang anak.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mission-card">
                        <div class="mission-number">3</div>
                        <h4>Mendukung Orang Tua</h4>
                        <p>Membantu orang tua dalam memantau dan mengoptimalkan tumbuh kembang buah hati mereka.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Pengguna Aktif</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Artikel Tersedia</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Resep MPASI</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Akses Kapan Saja</div>
                    </div>
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
                        <h5 class="mb-0">Panduan 1000 Hari</h5>
                    </div>
                    <p>Platform terpercaya untuk mendampingi 1000 hari pertama kehidupan buah hati Anda.</p>
                    <p><i class="bi bi-envelope me-2"></i>andikanadapdap02@gmail.com</p>
                    <p><i class="bi bi-telephone me-2"></i>+62 821-3456-7890</p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Navigasi</h5>
                    <ul>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#misi">Misi Kami</a></li>
                        <li><a href="{{ route('articles.index') }}">Artikel</a></li>
                        <li><a href="{{ route('login') }}">Masuk</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Fitur</h5>
                    <ul>
                        <li><a href="#">Artikel 1000 HPK</a></li>
                        <li><a href="#">Resep MPASI</a></li>
                        <li><a href="#">Stimulasi</a></li>
                        <li><a href="#">Forum</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                    <h5>Kebijakan</h5>
                     <ul>
                        <li><a href="/privacy-policy">kebijakan privasi</a></li>
                        <li><a href="/data-deletion">Penghapusan Data Pengguna</a></li>
                        <li><a href="/terms-and-conditions">Syarat & Ketentuan</a></li>
                    </ul>
                    <p class="mt-3"><strong>Newsletter</strong></p>
                    <p class="small">Dapatkan tips parenting terbaru langsung ke email Anda.</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>
                    &copy; 2025 Panduan 1000 Hari. All rights reserved. |
                    <a href="/privacy-policy" target="_blank">Privacy and Policy</a> |
                    Contact: <a href="https://wa.me/6282167114827" target="_blank">+62 821-6711-4827</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
