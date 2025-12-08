<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stimulasi & Permainan - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #3B82F6; --secondary-color: #5CE1E6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 0; }
        .logo { width: 45px; height: 45px; background: var(--secondary-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo i { color: white; font-size: 24px; }
        .nav-link { color: #1e293b !important; font-weight: 500; margin: 0 10px; transition: color 0.3s; }
        .nav-link:hover { color: var(--primary-color) !important; }
        .navbar-brand { font-weight: 600; color: #1e293b !important; }
        .hero-stimulation { background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%); padding: 60px 0 40px; }
        .hero-stimulation h1 { color: #1e293b; font-weight: 700; margin-bottom: 16px; }
        .search-bar { background: white; border-radius: 12px; padding: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .search-bar input { border: none; padding: 12px 20px; }
        .search-bar button { background: var(--primary-color); border: none; padding: 12px 24px; border-radius: 8px; color: white; font-weight: 600; }
        .filter-pills .btn { border-radius: 20px; padding: 8px 20px; margin-right: 10px; margin-bottom: 10px; border: 2px solid #e2e8f0; background: white; color: #64748b; font-weight: 500; }
        .filter-pills .btn.active { background: var(--primary-color); border-color: var(--primary-color); color: white; }
        .stimulation-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.06); transition: all 0.3s; height: 100%; }
        .stimulation-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.12); }
        .stimulation-image { width: 100%; height: 200px; object-fit: cover; background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%); display: flex; align-items: center; justify-content: center; }
        .stimulation-category { display: inline-block; background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%); color: var(--primary-color); padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 12px; }
        .age-badge { position: absolute; top: 12px; right: 12px; background: white; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('stimulations.index') }}">Stimulasi & Permainan</a></li>
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
                        <li class="nav-item ms-3"><a href="{{ route('login') }}" class="btn btn-outline-primary">Masuk</a></li>
                        <li class="nav-item ms-2"><a href="{{ route('register') }}" class="btn btn-primary">Daftar Gratis</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-stimulation">
        <div class="container">
            <div class="text-center mb-4">
                <h1><i class="bi bi-puzzle me-3"></i>Stimulasi & Permainan</h1>
                <p class="lead text-muted">Panduan aktivitas edukatif untuk perkembangan optimal anak</p>
            </div>
            
            <form action="{{ route('stimulations.index') }}" method="GET" class="search-bar d-flex mb-4">
                <input type="text" name="search" class="form-control" placeholder="Cari aktivitas stimulasi..." value="{{ request('search') }}">
                <button type="submit">Cari</button>
            </form>

            <div class="filter-pills text-center mb-3">
                <h6 class="text-muted mb-3">Filter Kategori:</h6>
                <a href="{{ route('stimulations.index') }}" class="btn {{ !request('category') ? 'active' : '' }}">Semua</a>
                <a href="{{ route('stimulations.index', ['category' => 'Motorik Kasar']) }}" class="btn {{ request('category') == 'Motorik Kasar' ? 'active' : '' }}">Motorik Kasar</a>
                <a href="{{ route('stimulations.index', ['category' => 'Motorik Halus']) }}" class="btn {{ request('category') == 'Motorik Halus' ? 'active' : '' }}">Motorik Halus</a>
                <a href="{{ route('stimulations.index', ['category' => 'Kognitif']) }}" class="btn {{ request('category') == 'Kognitif' ? 'active' : '' }}">Kognitif</a>
                <a href="{{ route('stimulations.index', ['category' => 'Bahasa']) }}" class="btn {{ request('category') == 'Bahasa' ? 'active' : '' }}">Bahasa</a>
                <a href="{{ route('stimulations.index', ['category' => 'Sosial-Emosional']) }}" class="btn {{ request('category') == 'Sosial-Emosional' ? 'active' : '' }}">Sosial-Emosional</a>
            </div>

            <div class="filter-pills text-center">
                <h6 class="text-muted mb-3">Filter Usia:</h6>
                <a href="{{ route('stimulations.index') }}" class="btn {{ !request('age_range') ? 'active' : '' }}">Semua Usia</a>
                <a href="{{ route('stimulations.index', ['age_range' => '0-3 bulan']) }}" class="btn {{ request('age_range') == '0-3 bulan' ? 'active' : '' }}">0-3 bulan</a>
                <a href="{{ route('stimulations.index', ['age_range' => '4-6 bulan']) }}" class="btn {{ request('age_range') == '4-6 bulan' ? 'active' : '' }}">4-6 bulan</a>
                <a href="{{ route('stimulations.index', ['age_range' => '7-9 bulan']) }}" class="btn {{ request('age_range') == '7-9 bulan' ? 'active' : '' }}">7-9 bulan</a>
                <a href="{{ route('stimulations.index', ['age_range' => '10-12 bulan']) }}" class="btn {{ request('age_range') == '10-12 bulan' ? 'active' : '' }}">10-12 bulan</a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <!-- Add Stimulation Button for Admin -->
            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="mb-4 text-end">
                        <a href="{{ route('stimulations.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Stimulasi Baru
                        </a>
                    </div>
                @endif
            @endauth

            @if($stimulations->count() > 0)
                <div class="row g-4">
                    @foreach($stimulations as $stimulation)
                        <div class="col-md-6 col-lg-4">
                            <div class="stimulation-card">
                                <div class="position-relative">
                                    <div class="stimulation-image">
                                        @if($stimulation->image)
                                            <img src="{{ asset('storage/' . $stimulation->image) }}" alt="{{ $stimulation->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                                        @else
                                            <i class="bi bi-puzzle" style="font-size: 72px; color: var(--primary-color);"></i>
                                        @endif
                                    </div>
                                    <span class="age-badge">{{ $stimulation->age_range }}</span>
                                </div>
                                <div class="p-3">
                                    <span class="stimulation-category">{{ $stimulation->category }}</span>
                                    <h5 class="fw-bold text-dark mb-2">{{ $stimulation->title }}</h5>
                                    <p class="text-muted small mb-3">{{ Str::limit($stimulation->description, 80) }}</p>
                                    <div class="d-flex justify-content-between text-muted small">
                                        <span><i class="bi bi-clock me-1"></i>{{ $stimulation->duration }} menit</span>
                                        <span><i class="bi bi-heart me-1"></i>{{ $stimulation->likes }}</span>
                                    </div>

                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <!-- Admin Action Buttons -->
                                            <div class="action-buttons">
                                                <a href="{{ route('stimulations.edit', $stimulation->id) }}" class="btn btn-update">
                                                    <i class="bi bi-arrow-repeat"></i> Update
                                                </a>
                                                <a href="{{ route('stimulations.show', $stimulation->slug) }}" class="btn btn-detail">
                                                    <i class="bi bi-info-circle"></i> Detail
                                                </a>
                                                <form action="{{ route('stimulations.destroy', $stimulation->id) }}" method="POST" style="flex: 1;" 
                                                      onsubmit="return confirm('Yakin ingin menghapus stimulasi ini?')">
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
                                                <a href="{{ route('stimulations.show', $stimulation->slug) }}" class="btn btn-primary w-100">
                                                    <i class="bi bi-play-circle me-2"></i>Lihat Detail
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <!-- Public/Guest Button -->
                                        <div class="mt-3">
                                            <a href="{{ route('stimulations.show', $stimulation->slug) }}" class="btn btn-primary w-100">
                                                <i class="bi bi-play-circle me-2"></i>Lihat Detail
                                            </a>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 d-flex justify-content-center">{{ $stimulations->links() }}</div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-search" style="font-size: 80px; color: #cbd5e1;"></i>
                    <h4 class="mt-3">Tidak ada aktivitas ditemukan</h4>
                </div>
            @endif
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
