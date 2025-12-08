<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #10B981; --secondary-color: #5CE1E6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 0; }
        .logo { width: 45px; height: 45px; background: var(--secondary-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo i { color: white; font-size: 24px; }
        .hero-forum { background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%); padding: 60px 0 40px; }
        .hero-forum h1 { color: #1e293b; font-weight: 700; margin-bottom: 16px; }
        .search-bar { background: white; border-radius: 12px; padding: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .search-bar input { border: none; padding: 12px 20px; }
        .search-bar button { background: var(--primary-color); border: none; padding: 12px 24px; border-radius: 8px; color: white; font-weight: 600; }
        .filter-pills .btn { border-radius: 20px; padding: 8px 20px; margin-right: 10px; margin-bottom: 10px; border: 2px solid #e2e8f0; background: white; color: #64748b; font-weight: 500; }
        .filter-pills .btn.active { background: var(--primary-color); border-color: var(--primary-color); color: white; }
        .discussion-card { background: white; border-radius: 12px; padding: 20px; margin-bottom: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.3s; }
        .discussion-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.1); }
        .discussion-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-right: 8px; }
        .badge-kehamilan { background: #FEE2E2; color: #DC2626; }
        .badge-mpasi { background: #FEF3C7; color: #F59E0B; }
        .badge-kesehatan { background: #DBEAFE; color: #2563EB; }
        .badge-perkembangan { background: #E0E7FF; color: #6366F1; }
        .badge-lainnya { background: #F3F4F6; color: #6B7280; }
        .closed-badge { background: #E5E7EB; color: #6B7280; padding: 4px 12px; border-radius: 20px; font-size: 12px; }
        .stats { color: #64748b; font-size: 14px; }
        .stats i { margin-right: 4px; }
        .avatar { width: 40px; height: 40px; background: linear-gradient(135deg, #5CE1E6, #2E90FA); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; }
        .btn-create { background: var(--primary-color); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; box-shadow: 0 4px 12px rgba(16,185,129,0.3); }
        .btn-create:hover { background: #059669; color: white; }
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
                                <li><a class="dropdown-item" href="{{ route('tracker.index') }}"><i class="bi bi-activity me-2"></i>Tracker Sensorik</a></li>
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

    <section class="hero-forum">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1><i class="bi bi-chat-dots me-2"></i>Forum Diskusi</h1>
                    <p>Berbagi pengalaman dan bertanya seputar 1000 hari pertama kehidupan</p>
                    <form action="{{ route('discussions.index') }}" method="GET" class="search-bar d-flex gap-2 mt-4">
                        <input type="text" name="search" class="form-control flex-grow-1" placeholder="Cari diskusi..." value="{{ request('search') }}">
                        <button type="submit"><i class="bi bi-search me-2"></i>Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="filter-pills">
                    <a href="{{ route('discussions.index') }}" class="btn {{ !request('category') ? 'active' : '' }}">Semua</a>
                    @foreach($categories as $cat)
                        <a href="{{ route('discussions.index', ['category' => $cat]) }}" class="btn {{ request('category') == $cat ? 'active' : '' }}">{{ $cat }}</a>
                    @endforeach
                </div>
                @auth
                    <a href="{{ route('discussions.create') }}" class="btn-create"><i class="bi bi-plus-lg me-2"></i>Buat Diskusi</a>
                @else
                    <a href="{{ route('login') }}" class="btn-create"><i class="bi bi-plus-lg me-2"></i>Buat Diskusi</a>
                @endauth
            </div>

            @if($discussions->count() > 0)
                @foreach($discussions as $discussion)
                    <div class="discussion-card">
                        <div class="d-flex gap-3">
                            <div class="avatar">{{ substr($discussion->author->name, 0, 1) }}</div>
                            <div class="flex-grow-1">
                                <div class="mb-2">
                                    <span class="discussion-badge badge-{{ strtolower($discussion->category) }}">{{ $discussion->category }}</span>
                                    @if($discussion->is_closed)
                                        <span class="closed-badge">Ditutup</span>
                                    @endif
                                </div>
                                <a href="{{ route('discussions.show', $discussion->slug) }}" class="text-decoration-none">
                                    <h5 class="fw-bold text-dark mb-2">{{ $discussion->title }}</h5>
                                </a>
                                <p class="text-muted mb-2">{{ Str::limit($discussion->content, 150) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">oleh <strong>{{ $discussion->author->name }}</strong> • {{ $discussion->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="stats">
                                        <span class="me-3"><i class="bi bi-chat"></i>{{ $discussion->replies_count }}</span>
                                        <span><i class="bi bi-heart"></i>{{ $discussion->likes }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-4 d-flex justify-content-center">{{ $discussions->links() }}</div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-chat-left-dots" style="font-size: 80px; color: #cbd5e1;"></i>
                    <h4 class="mt-3">Belum ada diskusi</h4>
                    <p class="text-muted">Jadilah yang pertama memulai diskusi!</p>
                </div>
            @endif
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 