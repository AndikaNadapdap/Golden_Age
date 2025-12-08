<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Progress User - Golden Age</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #8B5CF6;
            --secondary-color: #7C3AED;
        }
        body { background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .hero-section { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 60px 0 40px; text-align: center; margin-bottom: 40px; }
        .hero-section h1 { font-weight: 700; font-size: 36px; margin-bottom: 15px; }
        .stats-card { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.1); margin-bottom: 30px; }
        .stats-row { display: flex; justify-content: space-around; gap: 20px; }
        .stat-item { text-align: center; }
        .stat-number { font-size: 48px; font-weight: 700; color: var(--primary-color); }
        .stat-label { color: #6b7280; font-size: 14px; margin-top: 5px; }
        .search-box { background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.1); margin-bottom: 30px; }
        .user-card { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.1); margin-bottom: 20px; transition: all 0.3s; border-left: 4px solid var(--primary-color); }
        .user-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(139, 92, 246, 0.2); }
        .user-info h5 { color: #1f2937; font-weight: 700; margin-bottom: 5px; }
        .user-email { color: #6b7280; font-size: 14px; margin-bottom: 15px; }
        .progress { height: 30px; border-radius: 15px; background: #F3F4F6; }
        .progress-bar { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); border-radius: 15px; font-weight: 600; }
        .progress-text { display: flex; justify-content: space-between; align-items: center; margin-top: 10px; }
        .progress-label { color: #6b7280; font-size: 14px; }
        .last-update { color: #9ca3af; font-size: 13px; }
        .btn-detail { background: var(--primary-color); color: white; border: none; padding: 10px 25px; border-radius: 10px; font-weight: 600; transition: all 0.3s; }
        .btn-detail:hover { background: var(--secondary-color); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3); }
        .btn-export { background: #059669; color: white; border: none; padding: 12px 30px; border-radius: 10px; font-weight: 600; }
        .btn-export:hover { background: #047857; }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1><i class="bi bi-people me-3"></i>Monitoring Progress User</h1>
            <p>Pantau perkembangan tracking milestone semua pengguna</p>
        </div>
    </section>

    <div class="container mb-5">
        <!-- Statistics -->
        <div class="stats-card">
            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-number">{{ $totalUsers }}</div>
                    <div class="stat-label">Total User</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $totalMilestones }}</div>
                    <div class="stat-label">Total Milestone</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ number_format($averageProgress, 1) }}%</div>
                    <div class="stat-label">Rata-rata Progress</div>
                </div>
            </div>
        </div>

        <!-- Search & Export -->
        <div class="search-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <form action="{{ route('admin.tracker.progress') }}" method="GET">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" 
                                   placeholder="Cari nama atau email user..." 
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-export">
                        <i class="bi bi-download me-2"></i>Export Excel
                    </button>
                </div>
            </div>
        </div>

        <!-- User List -->
        @if($users->count() > 0)
            @foreach($users as $user)
                @php
                    $progressPercentage = $totalMilestones > 0 ? round(($user->milestones_completed / $totalMilestones) * 100) : 0;
                    $lastUpdate = $user->childProgress->first()?->achieved_date ?? null;
                @endphp
                <div class="user-card">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="user-info">
                                <h5><i class="bi bi-person-circle me-2"></i>{{ $user->name }}</h5>
                                <div class="user-email">{{ $user->email }}</div>
                                
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ $progressPercentage }}%;" 
                                         aria-valuenow="{{ $progressPercentage }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        {{ $progressPercentage }}%
                                    </div>
                                </div>
                                
                                <div class="progress-text">
                                    <span class="progress-label">
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ $user->milestones_completed }}/{{ $totalMilestones }} milestone tercapai
                                    </span>
                                    @if($lastUpdate)
                                        <span class="last-update">
                                            <i class="bi bi-clock me-1"></i>
                                            Terakhir update: {{ $lastUpdate->diffForHumans() }}
                                        </span>
                                    @else
                                        <span class="last-update">
                                            <i class="bi bi-clock me-1"></i>
                                            Belum ada progress
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.tracker.detail', $user->id) }}" class="btn btn-detail">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-4 d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 80px; color: #cbd5e1;"></i>
                <h4 class="mt-3">Tidak ada user ditemukan</h4>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
