<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $stimulation->title }} - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #3B82F6; --secondary-color: #5CE1E6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 0; }
        .logo { width: 45px; height: 45px; background: var(--secondary-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo i { color: white; font-size: 24px; }
        .header-image { width: 100%; height: 400px; background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%); display: flex; align-items: center; justify-content: center; }
        .content-card { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.06); margin-top: -60px; position: relative; z-index: 10; }
        .category-badge { display: inline-block; background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%); color: var(--primary-color); padding: 8px 16px; border-radius: 20px; font-weight: 600; }
        .info-box { background: #f8fafc; border-left: 4px solid var(--primary-color); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; }
        .benefit-item { padding: 0.5rem 0; border-bottom: 1px solid #e2e8f0; }
        .benefit-item:last-child { border-bottom: none; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <div class="logo"><i class="bi bi-heart-fill"></i></div>
                <span class="fw-bold">Paduan 1000 Hari</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}">Artikel</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('recipes.index') }}">Resep</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('stimulations.index') }}">Stimulasi & Permainan</a></li>
                    @auth
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> Profile
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('discussions.index') }}"><i class="bi bi-chat-dots me-2"></i>Forum Diskusi</a></li>
                                <li><a class="dropdown-item" href="{{ route('welcome') }}"><i class="bi bi-activity me-2"></i>Tracker Sensorik</a></li>
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
                        <li class="nav-item ms-3"><a href="{{ route('login') }}" class="btn btn-outline-primary">Masuk</a></li>
                        <li class="nav-item ms-2"><a href="{{ route('register') }}" class="btn btn-primary">Daftar Gratis</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="header-image">
        <i class="bi bi-puzzle" style="font-size: 120px; color: var(--primary-color);"></i>
    </div>

    <div class="container pb-5">
        <div class="content-card">
            <div class="mb-4">
                <a href="{{ route('stimulations.index') }}" class="text-decoration-none text-muted">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                </a>
            </div>

            <div class="mb-4">
                <span class="category-badge">{{ $stimulation->category }}</span>
                <span class="badge bg-secondary ms-2">{{ $stimulation->age_range }}</span>
            </div>

            <h1 class="fw-bold mb-3">{{ $stimulation->title }}</h1>
            <p class="lead text-muted">{{ $stimulation->description }}</p>

            <div class="d-flex gap-4 text-muted mb-4">
                <span><i class="bi bi-clock me-2"></i>{{ $stimulation->duration }}</span>
                <span><i class="bi bi-heart me-2"></i>{{ $stimulation->likes }} suka</span>
            </div>

            <hr class="my-4">

            @if($stimulation->materials)
            <div class="mb-4">
                <h4 class="fw-bold mb-3"><i class="bi bi-box me-2" style="color: var(--primary-color);"></i>Alat dan Bahan</h4>
                <div class="info-box">
                    <p class="mb-0">{{ $stimulation->materials }}</p>
                </div>
            </div>
            @endif

            <div class="mb-4">
                <h4 class="fw-bold mb-3"><i class="bi bi-list-ol me-2" style="color: var(--primary-color);"></i>Cara Bermain</h4>
                <div class="info-box">
                    {!! nl2br(e($stimulation->instructions)) !!}
                </div>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-3"><i class="bi bi-star me-2" style="color: var(--primary-color);"></i>Manfaat</h4>
                <div class="bg-light p-3 rounded">
                    @foreach(explode(';', $stimulation->benefits) as $benefit)
                        <div class="benefit-item">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            {{ trim($benefit) }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Tips:</strong> Selalu awasi anak saat bermain dan sesuaikan aktivitas dengan kemampuan dan kesiapan anak. Jika anak menunjukkan tanda-tanda tidak nyaman, hentikan aktivitas dan coba lagi di lain waktu.
            </div>

            <div class="d-flex gap-3 mt-4">
                <form action="{{ route('stimulations.like', $stimulation->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-heart me-2"></i>Suka ({{ $stimulation->likes }})
                    </button>
                </form>
                <a href="{{ route('stimulations.index') }}" class="btn btn-primary">
                    <i class="bi bi-grid me-2"></i>Lihat Aktivitas Lainnya
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
