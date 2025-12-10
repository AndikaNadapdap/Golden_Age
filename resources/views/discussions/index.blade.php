<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #10b981;
            --secondary-color: #5CE1E6;
        }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 1rem 0;
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
            margin: 0 10px;
            font-weight: 500;
            color: #1e293b;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .btn-logout {
            padding: 8px 24px;
            border: 2px solid #EF4444;
            color: #EF4444;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background-color: #EF4444;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        
        .hero-section {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
        }
        
        .search-box {
            background: white;
            border-radius: 50px;
            padding: 5px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .search-box input {
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
        }
        
        .search-box input:focus {
            outline: none;
            box-shadow: none;
        }
        
        .search-box button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .search-box button:hover {
            background: #059669;
            transform: translateY(-2px);
        }
        
        .filter-btn {
            padding: 10px 25px;
            border-radius: 25px;
            border: 2px solid #e5e7eb;
            background: white;
            color: #6b7280;
            font-weight: 500;
            transition: all 0.3s;
            margin: 5px;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .discussion-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }
        
        .discussion-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-left-color: var(--primary-color);
        }
        
        .category-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .category-kehamilan { background: #FEF3C7; color: #D97706; }
        .category-mpasi { background: #DBEAFE; color: #2563EB; }
        .category-kesehatan { background: #FEE2E2; color: #DC2626; }
        .category-perkembangan { background: #D1FAE5; color: #059669; }
        .category-lainnya { background: #E5E7EB; color: #6B7280; }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #5CE1E6, #2E90FA);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #6b7280;
            font-size: 14px;
        }
        
        .stat-item i {
            color: #9ca3af;
        }
        
        .btn-create {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--primary-color);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .btn-create:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <div class="logo">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <span class="fw-bold">Paduan 1000 Hari</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        @if(Auth::user()->role === 'admin')
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('milestones.index') }}">Milestone</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('discussions.index') }}">Diskusi</a>
                            </li>
                            <li class="nav-item ms-3">
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}">Artikel</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('recipes.index') }}">Resep</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('stimulations.index') }}">Stimulasi & Permainan</a></li>
                            
                            <li class="nav-item dropdown ms-3">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-1"></i> Profile
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile Saya</a></li>
                                    <li><a class="dropdown-item" href="{{ route('discussions.index') }}"><i class="bi bi-chat-dots me-2"></i>Forum Diskusi</a></li>
                                    @if(Auth::user()->role === 'parent')
                                        <li><a class="dropdown-item" href="{{ route('tracker.index') }}"><i class="bi bi-activity me-2"></i>Tracker Sensorik</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endif
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}">Artikel</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('recipes.index') }}">Resep</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('stimulations.index') }}">Stimulasi & Permainan</a></li>
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
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">
                <i class="bi bi-chat-dots me-3"></i>Forum Diskusi
            </h1>
            <p class="lead mb-5">Berbagi pengalaman dan bertanya seputar 1000 hari pertama kehidupan</p>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="{{ route('discussions.index') }}" method="GET">
                        <div class="search-box d-flex">
                            <input type="text" name="search" class="form-control" placeholder="Cari diskusi..." value="{{ request('search') }}">
                            <button type="submit" class="btn">
                                <i class="bi bi-search me-2"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <!-- Filter Categories -->
        <div class="text-center mb-4">
            <a href="{{ route('discussions.index') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">Semua</a>
            <a href="{{ route('discussions.index', ['category' => 'Kehamilan']) }}" class="filter-btn {{ request('category') == 'Kehamilan' ? 'active' : '' }}">Kehamilan</a>
            <a href="{{ route('discussions.index', ['category' => 'MPASI']) }}" class="filter-btn {{ request('category') == 'MPASI' ? 'active' : '' }}">MPASI</a>
            <a href="{{ route('discussions.index', ['category' => 'Kesehatan']) }}" class="filter-btn {{ request('category') == 'Kesehatan' ? 'active' : '' }}">Kesehatan</a>
            <a href="{{ route('discussions.index', ['category' => 'Perkembangan']) }}" class="filter-btn {{ request('category') == 'Perkembangan' ? 'active' : '' }}">Perkembangan</a>
            <a href="{{ route('discussions.index', ['category' => 'Lainnya']) }}" class="filter-btn {{ request('category') == 'Lainnya' ? 'active' : '' }}">Lainnya</a>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @forelse($discussions as $discussion)
                    @if($discussion->author)
                        <div class="discussion-card">
                            <div class="d-flex align-items-start gap-3">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($discussion->author->name, 0, 1)) }}
                                </div>
                                
                                <div class="flex-grow-1">
                                    <span class="category-badge category-{{ strtolower(str_replace(' ', '', $discussion->category)) }}">
                                        {{ $discussion->category }}
                                    </span>
                                    
                                    <h5 class="fw-bold mb-2">
                                        <a href="{{ route('discussions.show', $discussion->slug) }}" class="text-dark text-decoration-none">
                                            {{ $discussion->title }}
                                        </a>
                                    </h5>
                                    
                                    <p class="text-muted mb-3">{{ Str::limit($discussion->content, 200) }}</p>
                                    
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="stat-item">
                                            <i class="bi bi-person"></i>
                                            <span>oleh <strong>{{ $discussion->author->name }}</strong></span>
                                        </div>
                                        <div class="stat-item">
                                            <i class="bi bi-clock"></i>
                                            <span>{{ $discussion->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="stat-item">
                                            <i class="bi bi-chat"></i>
                                            <span>{{ $discussion->replies_count }} balasan</span>
                                        </div>
                                        <div class="stat-item">
                                            <i class="bi bi-heart{{ Auth::check() && $discussion->isLikedBy(Auth::user()) ? '-fill text-danger' : '' }}"></i>
                                            <span>{{ $discussion->likes }} suka</span>
                                        </div>
                                        
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                            <div class="ms-auto">
                                                <form action="{{ route('discussions.destroy', $discussion->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus diskusi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i> Hapus Diskusi
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-chat-dots text-muted" style="font-size: 80px;"></i>
                        <h4 class="text-muted mt-3">Belum ada diskusi</h4>
                        <p class="text-muted">Jadilah yang pertama memulai diskusi!</p>
                    </div>
                @endforelse

                @if($discussions->hasPages())
                    <div class="mt-4">
                        {{ $discussions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Create Discussion Button -->
    @auth
        @if(Auth::user()->role !== 'admin')
            <a href="{{ route('discussions.create') }}" class="btn-create" title="Buat Diskusi Baru">
                <i class="bi bi-plus-lg"></i>
            </a>
        @endif
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>