<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Milestone - Golden Age</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #10B981;
            --secondary-color: #059669;
        }
        body { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .hero-section { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 60px 0 40px; text-align: center; margin-bottom: 40px; }
        .hero-section h1 { font-weight: 700; font-size: 36px; margin-bottom: 15px; }
        .hero-section p { font-size: 18px; opacity: 0.95; }
        .filter-section { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.1); margin-bottom: 30px; }
        .filter-pills { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center; }
        .filter-pills .btn { padding: 10px 20px; border-radius: 25px; border: 2px solid #e5e7eb; background: white; color: #6b7280; font-weight: 600; transition: all 0.3s; }
        .filter-pills .btn:hover { border-color: var(--primary-color); color: var(--primary-color); transform: translateY(-2px); }
        .filter-pills .btn.active { background: var(--primary-color); color: white; border-color: var(--primary-color); }
        .milestone-group { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.1); margin-bottom: 30px; }
        .milestone-group h4 { color: var(--primary-color); font-weight: 700; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 3px solid #D1FAE5; }
        .milestone-card { background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%); border-radius: 12px; padding: 20px; margin-bottom: 15px; border-left: 4px solid var(--primary-color); transition: all 0.3s; position: relative; }
        .milestone-card:hover { transform: translateX(5px); box-shadow: 0 6px 20px rgba(16, 185, 129, 0.15); }
        .milestone-badge { display: inline-block; background: var(--primary-color); color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 10px; }
        .milestone-name { font-weight: 700; color: #1f2937; font-size: 18px; margin-bottom: 10px; }
        .milestone-description { color: #6b7280; margin-bottom: 10px; font-size: 14px; }
        .milestone-tips { background: white; border-radius: 8px; padding: 12px; margin-top: 10px; border-left: 3px solid #FBBF24; }
        .milestone-tips strong { color: #D97706; }
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
<body>
    <!-- Navbar -->
<<<<<<< HEAD
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <div style="width: 45px; height: 45px; background: #5CE1E6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-heart-fill" style="color: white; font-size: 24px;"></i>
                </div>
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
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                                    <li><a class="dropdown-item" href="{{ route('discussions.index') }}"><i class="bi bi-chat-dots me-2"></i>Forum Diskusi</a></li>
                                @elseif(Auth::user()->role === 'parent')
                                    <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person me-2"></i>Profile Saya</a></li>
                                    <li><a class="dropdown-item" href="{{ route('discussions.index') }}"><i class="bi bi-chat-dots me-2"></i>Forum Diskusi</a></li>
                                    <li><a class="dropdown-item" href="{{ route('tracker.index') }}"><i class="bi bi-activity me-2"></i>Tracker Sensorik</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('profile.doctor') }}"><i class="bi bi-person-badge me-2"></i>Profile Saya</a></li>
                                    <li><a class="dropdown-item" href="{{ route('discussions.index') }}"><i class="bi bi-chat-dots me-2"></i>Forum Diskusi</a></li>
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
=======
    @include('partials.navbar')
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1><i class="bi bi-clipboard2-check me-3"></i>Kelola Milestone Perkembangan</h1>
            <p>Kelola milestone standar perkembangan anak usia 0-12 bulan</p>
        </div>
    </section>

    <div class="container mb-5">
        <!-- Admin Add Button -->
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="mb-4 text-end">
                    <a href="{{ route('milestones.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Milestone Baru
                    </a>
                </div>
            @endif
        @endauth

        <!-- Filter Section -->
        <div class="filter-section">
            <h6 class="text-muted mb-3">Filter Kategori:</h6>
            <div class="filter-pills">
                <a href="{{ route('milestones.index') }}" class="btn {{ !request('category') ? 'active' : '' }}">Semua Kategori</a>
                <a href="{{ route('milestones.index', ['category' => 'Motorik Kasar']) }}" class="btn {{ request('category') == 'Motorik Kasar' ? 'active' : '' }}">Motorik Kasar</a>
                <a href="{{ route('milestones.index', ['category' => 'Motorik Halus']) }}" class="btn {{ request('category') == 'Motorik Halus' ? 'active' : '' }}">Motorik Halus</a>
                <a href="{{ route('milestones.index', ['category' => 'Kognitif']) }}" class="btn {{ request('category') == 'Kognitif' ? 'active' : '' }}">Kognitif</a>
                <a href="{{ route('milestones.index', ['category' => 'Bahasa']) }}" class="btn {{ request('category') == 'Bahasa' ? 'active' : '' }}">Bahasa</a>
                <a href="{{ route('milestones.index', ['category' => 'Sosial-Emosional']) }}" class="btn {{ request('category') == 'Sosial-Emosional' ? 'active' : '' }}">Sosial-Emosional</a>
            </div>
            
            <h6 class="text-muted mb-3 mt-4">Filter Usia:</h6>
            <div class="filter-pills">
                <a href="{{ route('milestones.index', array_merge(request()->except('age_range'), [])) }}" class="btn {{ !request('age_range') ? 'active' : '' }}">Semua Usia</a>
                <a href="{{ route('milestones.index', array_merge(request()->except('age_range'), ['age_range' => '0-3 bulan'])) }}" class="btn {{ request('age_range') == '0-3 bulan' ? 'active' : '' }}">0-3 bulan</a>
                <a href="{{ route('milestones.index', array_merge(request()->except('age_range'), ['age_range' => '4-6 bulan'])) }}" class="btn {{ request('age_range') == '4-6 bulan' ? 'active' : '' }}">4-6 bulan</a>
                <a href="{{ route('milestones.index', array_merge(request()->except('age_range'), ['age_range' => '7-9 bulan'])) }}" class="btn {{ request('age_range') == '7-9 bulan' ? 'active' : '' }}">7-9 bulan</a>
                <a href="{{ route('milestones.index', array_merge(request()->except('age_range'), ['age_range' => '10-12 bulan'])) }}" class="btn {{ request('age_range') == '10-12 bulan' ? 'active' : '' }}">10-12 bulan</a>
            </div>
        </div>

        <!-- Milestones List -->
        @if($milestones->count() > 0)
            @php
                $groupedMilestones = $milestones->groupBy('age_range');
            @endphp

            @foreach($groupedMilestones as $ageRange => $ageGroupMilestones)
                <div class="milestone-group">
                    <h4><i class="bi bi-calendar-check me-2"></i>{{ $ageRange }}</h4>
                    
                    @foreach($ageGroupMilestones as $milestone)
                        <div class="milestone-card">
                            <span class="milestone-badge">{{ $milestone->category }}</span>
                            <div class="milestone-name">{{ $milestone->name }}</div>
                            <div class="milestone-description">{{ $milestone->description }}</div>
                            
                            @if($milestone->tips)
                                <div class="milestone-tips">
                                    <strong><i class="bi bi-lightbulb me-1"></i>Tips:</strong> {{ $milestone->tips }}
                                </div>
                            @endif

                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <!-- Admin Action Buttons -->
                                    <div class="action-buttons">
                                        <a href="{{ route('milestones.edit', $milestone->id) }}" class="btn btn-update">
                                            <i class="bi bi-arrow-repeat"></i> Update
                                        </a>
<<<<<<< HEAD
=======
                                        <a href="{{ route('milestones.show', $milestone->slug) }}" class="btn btn-detail">
                                            <i class="bi bi-info-circle"></i> Detail
                                        </a>
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
                                        <form action="{{ route('milestones.destroy', $milestone->id) }}" method="POST" style="flex: 1;" 
                                              onsubmit="return confirm('Yakin ingin menghapus milestone ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete w-100">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="mt-4 d-flex justify-content-center">
                {{ $milestones->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-search" style="font-size: 80px; color: #cbd5e1;"></i>
                <h4 class="mt-3">Tidak ada milestone ditemukan</h4>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<<<<<<< HEAD
=======
 
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
