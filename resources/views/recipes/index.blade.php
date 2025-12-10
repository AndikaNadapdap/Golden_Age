<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep MPASI - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #F59E0B; --secondary-color: #5CE1E6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 0; }
        .logo { width: 45px; height: 45px; background: var(--secondary-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo i { color: white; font-size: 24px; }
        .nav-link { color: #1e293b !important; font-weight: 500; margin: 0 10px; transition: color 0.3s; }
        .nav-link:hover { color: var(--primary-color) !important; }
        .navbar-brand { font-weight: 600; color: #1e293b !important; }
        .hero-recipe { background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%); padding: 60px 0 40px; }
        .hero-recipe h1 { color: #1e293b; font-weight: 700; margin-bottom: 16px; }
        .search-bar { background: white; border-radius: 12px; padding: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .search-bar input { border: none; padding: 12px 20px; }
        .search-bar button { background: var(--primary-color); border: none; padding: 12px 24px; border-radius: 8px; color: white; font-weight: 600; }
        .filter-pills .btn { border-radius: 20px; padding: 8px 20px; margin-right: 10px; margin-bottom: 10px; border: 2px solid #e2e8f0; background: white; color: #64748b; font-weight: 500; }
        .filter-pills .btn.active { background: var(--primary-color); border-color: var(--primary-color); color: white; }
        .recipe-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.06); transition: all 0.3s; height: 100%; }
        .recipe-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.12); }
        .recipe-image { width: 100%; height: 200px; object-fit: cover; }
        .recipe-category { display: inline-block; background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%); color: var(--primary-color); padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 12px; }
        .recipe-badge { position: absolute; top: 12px; right: 12px; background: white; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .action-buttons { display: flex; gap: 8px; margin-top: 16px; padding-top: 16px; border-top: 1px solid #f1f5f9; }
        .action-buttons .btn { flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 13px; transition: all 0.3s; border: none; }
        .btn-update { background: #F59E0B; color: white; }
        .btn-update:hover { background: #D97706; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3); }
        .btn-delete { background: #EF4444; color: white; }
        .btn-delete:hover { background: #DC2626; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }
        .btn-detail { background: #0EA5E9; color: white; }
        .btn-detail:hover { background: #0284C7; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3); }
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
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('milestones.index') }}">Milestone</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('discussions.index') }}">Diskusi</a></li>
                            <li class="nav-item ms-3">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item dropdown ms-3">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person me-2"></i>Profile Saya</a></li>
                                    <li><a class="dropdown-item" href="{{ route('discussions.index') }}"><i class="bi bi-chat-dots me-2"></i>Forum Diskusi</a></li>
                                    @if(auth()->user()->role === 'parent')
                                        <li><a class="dropdown-item" href="{{ route('tracker.index') }}"><i class="bi bi-activity me-2"></i>Tracker Sensorik</a></li>
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
                        @endif
                    @else
                        <li class="nav-item ms-3"><a href="{{ route('login') }}" class="btn btn-outline-primary">Masuk</a></li>
                        <li class="nav-item ms-2"><a href="{{ route('register') }}" class="btn btn-primary">Daftar Gratis</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-recipe">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1><i class="bi bi-egg-fried me-2"></i>Resep MPASI</h1>
                    <p>Kumpulan resep MPASI sehat dan bergizi untuk si kecil</p>
                    <form action="{{ route('recipes.index') }}" method="GET" class="search-bar d-flex gap-2 mt-4">
                        <input type="text" name="search" class="form-control flex-grow-1" placeholder="Cari resep..." value="{{ request('search') }}">
                        <button type="submit"><i class="bi bi-search me-2"></i>Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <!-- Add Recipe Button for Admin -->
            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="mb-4 text-end">
                        <a href="{{ route('recipes.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Resep Baru
                        </a>
                    </div>
                @endif
            @endauth

            <div class="filter-pills text-center mb-4">
                <a href="{{ route('recipes.index') }}" class="btn {{ !request('age_range') ? 'active' : '' }}">Semua Usia</a>
                @foreach($ageRanges as $range)
                    <a href="{{ route('recipes.index', ['age_range' => $range]) }}" class="btn {{ request('age_range') == $range ? 'active' : '' }}">{{ $range }}</a>
                @endforeach
            </div>

                @if($recipes->count() > 0)
                <div class="row g-4">
                    @foreach($recipes as $recipe)
                        <div class="col-md-6 col-lg-4">
                            <div class="recipe-card">
                                <div class="position-relative">
                                    @if($recipe->image)
                                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="recipe-image">
                                    @else
                                        <div class="recipe-image bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted" style="font-size: 48px;"></i>
                                        </div>
                                    @endif
                                    <span class="recipe-badge">{{ $recipe->age_range }}</span>
                                </div>
                                <div class="p-3">
                                    <span class="recipe-category">{{ $recipe->category }}</span>
                                    <h5 class="fw-bold text-dark mb-2">{{ $recipe->title }}</h5>
                                    <p class="text-muted small mb-3">{{ Str::limit($recipe->description, 80) }}</p>
                                    <div class="d-flex justify-content-between text-muted small">
                                        <span><i class="bi bi-clock me-1"></i>{{ $recipe->cooking_time }} menit</span>
                                        <span><i class="bi bi-heart me-1"></i>{{ $recipe->likes }}</span>
                                    </div>

                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <!-- Admin Action Buttons -->
                                            <div class="action-buttons">
                                                <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-update">
                                                    <i class="bi bi-arrow-repeat"></i> Update
                                                </a>
                                                <a href="{{ route('recipes.show', $recipe->slug) }}" class="btn btn-detail">
                                                    <i class="bi bi-info-circle"></i> Detail
                                                </a>
                                                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="flex: 1;" 
                                                      onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
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
                                                <a href="{{ route('recipes.show', $recipe->slug) }}" class="btn btn-primary w-100">
                                                    <i class="bi bi-book-half me-2"></i>Lihat Resep
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <!-- Public/Guest Button -->
                                        <div class="mt-3">
                                            <a href="{{ route('recipes.show', $recipe->slug) }}" class="btn btn-primary w-100">
                                                <i class="bi bi-book-half me-2"></i>Lihat Resep
                                            </a>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 d-flex justify-content-center">{{ $recipes->links() }}</div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-search" style="font-size: 80px; color: #cbd5e1;"></i>
                    <h4 class="mt-3">Tidak ada resep ditemukan</h4>
                </div>
            @endif
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
