<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .menu-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
            height: 100%;
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-heart-fill text-primary"></i>
                <strong>Paduan 1000 Hari</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="bi bi-house me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item active" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="admin-header">
        <div class="container">
            <h1 class="mb-2"><i class="bi bi-speedometer2 me-3"></i>Dashboard Admin</h1>
            <p class="mb-0 opacity-75">Selamat datang, {{ auth()->user()->name }}</p>
        </div>
    </div>

    <div class="container pb-5">
        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 rounded-circle bg-primary bg-opacity-10">
                                    <i class="bi bi-person-fill-gear fs-2 text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ \App\Models\User::where('role', 'doctor')->count() }}</h3>
                                <small class="text-muted">Total Dokter</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 rounded-circle bg-success bg-opacity-10">
                                    <i class="bi bi-people-fill fs-2 text-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ \App\Models\User::where('role', 'parent')->count() }}</h3>
                                <small class="text-muted">Orang Tua</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 rounded-circle bg-info bg-opacity-10">
                                    <i class="bi bi-newspaper fs-2 text-info"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ \App\Models\Article::count() }}</h3>
                                <small class="text-muted">Artikel</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 rounded-circle bg-warning bg-opacity-10">
                                    <i class="bi bi-chat-dots-fill fs-2 text-warning"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h3 class="mb-0">{{ \App\Models\Discussion::count() }}</h3>
                                <small class="text-muted">Diskusi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Manajemen -->
        <div class="row">
            <div class="col-12 mb-4">
                <h3><i class="bi bi-grid-3x3-gap-fill me-2"></i>Manajemen Konten</h3>
            </div>

            <!-- Kelola Dokter -->
            <div class="col-md-4 mb-4">
                <div class="card menu-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <div class="p-3 rounded-circle bg-primary bg-opacity-10 d-inline-block">
                                <i class="bi bi-person-fill-gear fs-1 text-primary"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-center mb-2">Kelola Dokter</h5>
                        <p class="text-muted text-center mb-3">Tambah, edit, dan kelola akun dokter</p>
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-primary w-100">
                            <i class="bi bi-arrow-right-circle me-2"></i>Kelola Dokter
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kelola Artikel -->
            <div class="col-md-4 mb-4">
                <div class="card menu-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <div class="p-3 rounded-circle bg-info bg-opacity-10 d-inline-block">
                                <i class="bi bi-newspaper fs-1 text-info"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-center mb-2">Kelola Artikel</h5>
                        <p class="text-muted text-center mb-3">Tambah, edit, dan hapus artikel</p>
                        <a href="{{ route('articles.index') }}" class="btn btn-info w-100">
                            <i class="bi bi-arrow-right-circle me-2"></i>Kelola Artikel
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kelola Resep -->
            <div class="col-md-4 mb-4">
                <div class="card menu-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <div class="p-3 rounded-circle bg-success bg-opacity-10 d-inline-block">
                                <i class="bi bi-egg-fried fs-1 text-success"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-center mb-2">Kelola Resep</h5>
                        <p class="text-muted text-center mb-3">Tambah, edit, dan hapus resep MPASI</p>
                        <a href="{{ route('recipes.index') }}" class="btn btn-success w-100">
                            <i class="bi bi-arrow-right-circle me-2"></i>Kelola Resep
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kelola Stimulasi -->
            <div class="col-md-4 mb-4">
                <div class="card menu-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <div class="p-3 rounded-circle bg-warning bg-opacity-10 d-inline-block">
                                <i class="bi bi-lightbulb-fill fs-1 text-warning"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-center mb-2">Kelola Stimulasi</h5>
                        <p class="text-muted text-center mb-3">Tambah, edit, dan hapus aktivitas stimulasi</p>
                        <a href="{{ route('stimulations.index') }}" class="btn btn-warning w-100">
                            <i class="bi bi-arrow-right-circle me-2"></i>Kelola Stimulasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kelola Milestone -->
            <div class="col-md-4 mb-4">
                <div class="card menu-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <div class="p-3 rounded-circle bg-danger bg-opacity-10 d-inline-block">
                                <i class="bi bi-trophy-fill fs-1 text-danger"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-center mb-2">Kelola Milestone</h5>
                        <p class="text-muted text-center mb-3">Tambah, edit, dan hapus milestone perkembangan</p>
                        <a href="{{ route('milestones.index') }}" class="btn btn-danger w-100">
                            <i class="bi bi-arrow-right-circle me-2"></i>Kelola Milestone
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kelola Diskusi -->
            <div class="col-md-4 mb-4">
                <div class="card menu-card">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <div class="p-3 rounded-circle bg-secondary bg-opacity-10 d-inline-block">
                                <i class="bi bi-chat-dots-fill fs-1 text-secondary"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-center mb-2">Kelola Diskusi</h5>
                        <p class="text-muted text-center mb-3">Moderasi dan kelola forum diskusi</p>
                        <a href="{{ route('discussions.index') }}" class="btn btn-secondary w-100">
                            <i class="bi bi-arrow-right-circle me-2"></i>Kelola Diskusi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
