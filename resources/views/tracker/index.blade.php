<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracker Sensorik - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #0EA5E9; --secondary-color: #5CE1E6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 0; }
        .logo { width: 45px; height: 45px; background: var(--secondary-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo i { color: white; font-size: 24px; }
        .hero-tracker { background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 100%); padding: 60px 0 40px; }
        .hero-tracker h1 { color: #1e293b; font-weight: 700; margin-bottom: 16px; }
        .filter-pills .btn { border-radius: 20px; padding: 8px 20px; margin-right: 10px; margin-bottom: 10px; border: 2px solid #e2e8f0; background: white; color: #64748b; font-weight: 500; }
        .filter-pills .btn.active { background: var(--primary-color); border-color: var(--primary-color); color: white; }
        .milestone-section { background: white; border-radius: 16px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .age-header { display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 3px solid var(--primary-color); }
        .age-icon { width: 60px; height: 60px; background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .category-badge { display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; margin-right: 8px; }
        .category-motorik-kasar { background: #DBEAFE; color: #1E40AF; }
        .category-motorik-halus { background: #FCE7F3; color: #BE185D; }
        .category-kognitif { background: #FEF3C7; color: #A16207; }
        .category-bahasa { background: #D1FAE5; color: #065F46; }
        .category-sosial-emosional { background: #E0E7FF; color: #4338CA; }
        .milestone-item { border: 2px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; margin-bottom: 1rem; transition: all 0.3s; }
        .milestone-item:hover { border-color: var(--primary-color); box-shadow: 0 4px 12px rgba(14,165,233,0.15); transform: translateX(4px); }
        .milestone-item.achieved { background: #F0FDF4; border-color: #10B981; }
        .milestone-checkbox { width: 24px; height: 24px; cursor: pointer; }
        .progress-stats { background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 100%); border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; }
        .stat-item { text-align: center; }
        .stat-number { font-size: 2rem; font-weight: 700; color: var(--primary-color); }
        .stat-label { color: #64748b; font-size: 0.9rem; }
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

    <section class="hero-tracker">
        <div class="container">
            <div class="text-center mb-4">
                <h1><i class="bi bi-activity me-3"></i>Tracker Sensorik & Motorik</h1>
                <p class="lead text-muted">Pantau perkembangan sensorik dan motorik anak sesuai milestone usianya</p>
            </div>

            <div class="filter-pills text-center">
                <h6 class="text-muted mb-3">Filter Kategori:</h6>
                <a href="{{ route('tracker.index') }}" class="btn {{ !request('category') ? 'active' : '' }}">Semua</a>
                <a href="{{ route('tracker.index', ['category' => 'Motorik Kasar']) }}" class="btn {{ request('category') == 'Motorik Kasar' ? 'active' : '' }}">Motorik Kasar</a>
                <a href="{{ route('tracker.index', ['category' => 'Motorik Halus']) }}" class="btn {{ request('category') == 'Motorik Halus' ? 'active' : '' }}">Motorik Halus</a>
                <a href="{{ route('tracker.index', ['category' => 'Kognitif']) }}" class="btn {{ request('category') == 'Kognitif' ? 'active' : '' }}">Kognitif</a>
                <a href="{{ route('tracker.index', ['category' => 'Bahasa']) }}" class="btn {{ request('category') == 'Bahasa' ? 'active' : '' }}">Bahasa</a>
                <a href="{{ route('tracker.index', ['category' => 'Sosial-Emosional']) }}" class="btn {{ request('category') == 'Sosial-Emosional' ? 'active' : '' }}">Sosial-Emosional</a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @auth
                @php
                    $totalMilestones = 0;
                    $achievedCount = 0;
                    foreach($groupedMilestones as $milestones) {
                        foreach($milestones as $milestone) {
                            $totalMilestones++;
                            if(isset($userProgress[$milestone->id]) && $userProgress[$milestone->id]->is_achieved) {
                                $achievedCount++;
                            }
                        }
                    }
                    $percentage = $totalMilestones > 0 ? round(($achievedCount / $totalMilestones) * 100) : 0;
                @endphp

                <div class="progress-stats">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-number">{{ $achievedCount }}</div>
                                <div class="stat-label">Milestone Tercapai</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-number">{{ $totalMilestones }}</div>
                                <div class="stat-label">Total Milestone</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <div class="stat-number">{{ $percentage }}%</div>
                                <div class="stat-label">Progress</div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Login untuk melacak perkembangan!</strong> Silakan login untuk menyimpan progress milestone anak Anda.
                </div>
            @endauth

            @foreach($groupedMilestones as $ageRange => $milestones)
                <div class="milestone-section">
                    <div class="age-header">
                        <div class="age-icon">
                            <i class="bi bi-calendar-heart" style="font-size: 28px; color: var(--primary-color);"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">Usia {{ $ageRange }}</h3>
                            <p class="text-muted mb-0">{{ $milestones->count() }} milestone perkembangan</p>
                        </div>
                    </div>

                    @foreach($milestones as $milestone)
                        @php
                            $isAchieved = isset($userProgress[$milestone->id]) && $userProgress[$milestone->id]->is_achieved;
                            $categoryClass = 'category-' . strtolower(str_replace([' ', '-'], '-', $milestone->category));
                        @endphp
                        
                        <div class="milestone-item {{ $isAchieved ? 'achieved' : '' }}" style="cursor: pointer;" onclick="window.location='{{ route('tracker.show', $milestone->id) }}'">
                            <div class="d-flex gap-3">
                                @auth
                                    <div onclick="event.stopPropagation()">
                                        <form action="{{ route('tracker.toggle', $milestone->id) }}" method="POST">
                                            @csrf
                                            <input type="checkbox" 
                                                   class="milestone-checkbox form-check-input" 
                                                   {{ $isAchieved ? 'checked' : '' }}
                                                   onchange="this.form.submit()">
                                        </form>
                                    </div>
                                @endauth
                                
                                <div class="flex-grow-1">
                                    <div class="mb-2">
                                        <span class="category-badge {{ $categoryClass }}">{{ $milestone->category }}</span>
                                        @if($isAchieved)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i>Tercapai
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <h5 class="mb-2">{{ $milestone->title }}</h5>
                                    <p class="text-muted mb-2">{{ $milestone->description }}</p>
                                    
                                    @if($milestone->tips)
                                        <div class="alert alert-light mb-2">
                                            <i class="bi bi-lightbulb text-warning me-2"></i>
                                            <strong>Tips:</strong> {{ Str::limit($milestone->tips, 100) }}
                                        </div>
                                    @endif

                                    <div class="mt-2">
                                        <small class="text-primary">
                                            <i class="bi bi-arrow-right-circle me-1"></i>
                                            Klik untuk lihat artikel, resep & stimulasi terkait
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            @if($groupedMilestones->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 80px; color: #cbd5e1;"></i>
                    <h4 class="mt-3">Tidak ada milestone ditemukan</h4>
                </div>
            @endif
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
