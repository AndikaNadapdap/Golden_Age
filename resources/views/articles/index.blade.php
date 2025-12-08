<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel 1000 Hari Pertama Kehidupan - Paduan 1000 Hari</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #EC4899;
            --secondary-color: #5CE1E6;
        }

        body {
            background: #f8fafc;
        }

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
            color: #1e293b !important;
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
            background: linear-gradient(135deg, var(--primary-color) 0%, #db2777 100%);
            border: none;
            font-weight: 600;
            padding: 8px 24px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(236, 72, 153, 0.3);
        }

        .hero-article {
            background: linear-gradient(135deg, #FCE7F3 0%, #FBCFE8 100%);
            padding: 60px 0 40px;
        }

        .hero-article h1 {
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .hero-article p {
            color: #64748b;
            font-size: 18px;
        }

        .search-bar {
            background: white;
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .search-bar input {
            border: none;
            padding: 12px 20px;
        }

        .search-bar input:focus {
            outline: none;
            box-shadow: none;
        }

        .search-bar button {
            background: var(--primary-color);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
        }

        .filter-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-pills .btn {
            border-radius: 20px;
            padding: 8px 20px;
            border: 2px solid #e2e8f0;
            background: white;
            color: #64748b;
            font-weight: 500;
        }

        .filter-pills .btn:hover,
        .filter-pills .btn.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .article-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            transition: all 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .article-card .card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .article-category {
            display: inline-block;
            background: linear-gradient(135deg, #FCE7F3 0%, #FBCFE8 100%);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .article-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .article-excerpt {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
            flex: 1;
        }

        .article-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            color: #94a3b8;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }

        .article-meta i {
            margin-right: 4px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }

        .action-buttons .btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
            border: none;
        }

        .btn-update {
            background: #F59E0B;
            color: white;
        }

        .btn-update:hover {
            background: #D97706;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .btn-delete {
            background: #EF4444;
            color: white;
        }

        .btn-delete:hover {
            background: #DC2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-detail {
            background: #0EA5E9;
            color: white;
        }

        .btn-detail:hover {
            background: #0284C7;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .no-articles {
            text-align: center;
            padding: 60px 20px;
        }

        .no-articles i {
            font-size: 80px;
            color: #cbd5e1;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('welcome') }}">
                <div class="logo">
                    <i class="bi bi-heart-fill text-white"></i>
                </div>
                <span class="fw-bold">Paduan 1000 Hari</span>
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
    <section class="hero-article">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1><i class="bi bi-journal-text me-2"></i>Artikel 1000 HPK</h1>
                    <p>Panduan lengkap untuk mendampingi 1000 Hari Pertama Kehidupan buah hati Anda</p>
                    
                    <!-- Search Bar -->
                    <form action="{{ route('articles.index') }}" method="GET" class="search-bar d-flex gap-2 mt-4">
                        <input type="text" name="search" class="form-control flex-grow-1" 
                               placeholder="Cari artikel..." value="{{ request('search') }}">
                        <button type="submit"><i class="bi bi-search me-2"></i>Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter & Articles -->
    <section class="py-5">
        <div class="container">
            <!-- Category Filter & Add Button -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div class="filter-pills">
                    <a href="{{ route('articles.index') }}" 
                       class="btn {{ !request('category') ? 'active' : '' }}">
                        Semua Artikel
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('articles.index', ['category' => $cat]) }}" 
                           class="btn {{ request('category') == $cat ? 'active' : '' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <div>
                            <a href="{{ route('articles.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Tambah Artikel Baru
                            </a>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Articles Grid -->
            @if($articles->count() > 0)
                <div class="row g-4">
                    @foreach($articles as $article)
                        <div class="col-md-6 col-lg-4">
                            <div class="article-card">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" 
                                         alt="{{ $article->title }}" 
                                         class="article-image">
                                @else
                                    <div class="article-image bg-light d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-muted" style="font-size: 48px;"></i>
                                    </div>
                                @endif
                                
                                <div class="card-body">
                                    <span class="article-category">{{ $article->category }}</span>
                                    <h3 class="article-title">{{ $article->title }}</h3>
                                    <p class="article-excerpt">{{ $article->excerpt }}</p>
                                    
                                    <div class="article-meta">
                                        <span>
                                            <i class="bi bi-calendar"></i>
                                            {{ $article->published_at->format('d M Y') }}
                                        </span>
                                        <span>
                                            <i class="bi bi-eye"></i>
                                            {{ $article->views }} views
                                        </span>
                                    </div>

                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <!-- Admin Action Buttons -->
                                            <div class="action-buttons">
                                                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-update">
                                                    <i class="bi bi-arrow-repeat"></i> Update
                                                </a>
                                                <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-detail">
                                                    <i class="bi bi-info-circle"></i> Detail
                                                </a>
                                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="flex: 1;" 
                                                      onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-delete w-100">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <!-- User Button -->
                                            <div class="mt-3">
                                                <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary w-100">
                                                    <i class="bi bi-book-half me-2"></i>Baca Selengkapnya
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <!-- Public/Guest Button -->
                                        <div class="mt-3">
                                            <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary w-100">
                                                <i class="bi bi-book-half me-2"></i>Baca Selengkapnya
                                            </a>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="no-articles">
                    <i class="bi bi-journal-x"></i>
                    <h4>Tidak ada artikel ditemukan</h4>
                    <p class="text-muted">Coba ubah pencarian atau filter Anda</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
