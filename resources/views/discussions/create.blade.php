<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Diskusi Baru - Forum Diskusi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #10B981; --secondary-color: #5CE1E6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 0; }
        .logo { width: 45px; height: 45px; background: var(--secondary-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo i { color: white; font-size: 24px; }
        .form-card { background: white; border-radius: 16px; padding: 40px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
        .form-label { font-weight: 600; color: #1e293b; margin-bottom: 8px; }
        .form-control, .form-select { border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(16,185,129,0.1); }
        .btn-submit { background: var(--primary-color); color: white; padding: 12px 32px; border: none; border-radius: 8px; font-weight: 600; }
        .btn-submit:hover { background: #059669; }
        .guidelines { background: #F0FDF4; border-left: 4px solid var(--primary-color); padding: 16px; border-radius: 8px; margin-bottom: 24px; }
        .guidelines h6 { color: var(--primary-color); font-weight: 700; }
        .guidelines ul { margin: 0; padding-left: 20px; }
        .guidelines li { margin-bottom: 8px; color: #166534; }
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

    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('discussions.index') }}">Forum Diskusi</a></li>
                <li class="breadcrumb-item active">Buat Diskusi Baru</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card">
                    <h2 class="fw-bold mb-4"><i class="bi bi-plus-circle me-2" style="color: var(--primary-color);"></i>Buat Diskusi Baru</h2>
                    
                    <div class="guidelines">
                        <h6><i class="bi bi-info-circle me-2"></i>Panduan Berdiskusi</h6>
                        <ul>
                            <li>Gunakan judul yang jelas dan deskriptif</li>
                            <li>Jelaskan pertanyaan atau topik dengan detail</li>
                            <li>Pilih kategori yang sesuai</li>
                            <li>Bersikap sopan dan menghormati sesama anggota</li>
                        </ul>
                    </div>

                    <form action="{{ route('discussions.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="category" class="form-label">
                                <i class="bi bi-tag me-1"></i>Kategori
                            </label>
                            <select name="category" id="category" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="title" class="form-label">
                                <i class="bi bi-chat-quote me-1"></i>Judul Diskusi
                            </label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Contoh: Bagaimana cara mengatasi bayi yang susah makan?" required maxlength="255">
                            <small class="text-muted">Maksimal 255 karakter</small>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label">
                                <i class="bi bi-file-text me-1"></i>Isi Diskusi
                            </label>
                            <textarea name="content" id="content" class="form-control" rows="8" placeholder="Jelaskan pertanyaan atau topik yang ingin Anda diskusikan..." required></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send me-2"></i>Buat Diskusi
                            </button>
                            <a href="{{ route('discussions.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-lg me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
