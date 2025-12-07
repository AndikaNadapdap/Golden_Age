<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Progress {{ $user->name }} - Golden Age</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #8B5CF6;
            --secondary-color: #7C3AED;
        }
        body { background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .hero-section { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 60px 0 40px; margin-bottom: 40px; }
        .hero-section h1 { font-weight: 700; font-size: 32px; margin-bottom: 10px; }
        .info-card { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.1); margin-bottom: 30px; }
        .info-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .info-item { flex: 1; }
        .info-label { color: #6b7280; font-size: 14px; margin-bottom: 5px; }
        .info-value { font-size: 18px; font-weight: 600; color: #1f2937; }
        .progress { height: 35px; border-radius: 20px; background: #F3F4F6; }
        .progress-bar { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); border-radius: 20px; font-weight: 700; font-size: 16px; }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .section-title { font-size: 24px; font-weight: 700; color: #1f2937; }
        .milestone-card { background: white; border-radius: 12px; padding: 20px; margin-bottom: 15px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); }
        .milestone-card.completed { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); border-left: 4px solid #10B981; }
        .milestone-card.pending { background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%); border-left: 4px solid #F59E0B; }
        .milestone-badge { display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 10px; }
        .badge-completed { background: #10B981; color: white; }
        .badge-pending { background: #F59E0B; color: white; }
        .milestone-name { font-weight: 700; color: #1f2937; font-size: 16px; margin-bottom: 8px; }
        .milestone-category { color: #6b7280; font-size: 14px; margin-bottom: 10px; }
        .achievement-date { color: #059669; font-size: 13px; font-weight: 600; }
        .achievement-notes { background: white; border-radius: 8px; padding: 12px; margin-top: 10px; font-style: italic; color: #4b5563; font-size: 14px; }
        .btn-back { background: #94a3b8; color: white; border: none; padding: 12px 30px; border-radius: 10px; font-weight: 600; }
        .btn-back:hover { background: #64748b; }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1><i class="bi bi-person-check me-3"></i>Detail Progress: {{ $user->name }}</h1>
            <p>{{ $user->email }}</p>
        </div>
    </section>

    <div class="container mb-5">
        <!-- User Info & Progress -->
        <div class="info-card">
            <div class="info-row">
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Terdaftar Sejak</div>
                    <div class="info-value">{{ $user->created_at->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Total Progress</div>
                    <div class="info-value">{{ $completedCount }}/{{ $totalMilestones }} Milestone</div>
                </div>
            </div>
            
            <div class="progress">
                <div class="progress-bar" role="progressbar" 
                     style="width: {{ $progressPercentage }}%;" 
                     aria-valuenow="{{ $progressPercentage }}" 
                     aria-valuemin="0" 
                     aria-valuemax="100">
                    {{ $progressPercentage }}%
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.tracker.progress') }}" class="btn btn-back">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar User
            </a>
        </div>

        <!-- Completed Milestones -->
        @if($completedMilestones->count() > 0)
            <div class="section-header">
                <h3 class="section-title">
                    <i class="bi bi-check-circle-fill me-2" style="color: #10B981;"></i>
                    Milestone Tercapai ({{ $completedCount }})
                </h3>
            </div>

            @foreach($completedMilestones as $progress)
                <div class="milestone-card completed">
                    <span class="milestone-badge badge-completed">
                        <i class="bi bi-check-lg me-1"></i>Tercapai
                    </span>
                    <span class="milestone-badge" style="background: #3B82F6; color: white;">
                        {{ $progress->milestone->category }}
                    </span>
                    <span class="milestone-badge" style="background: #6B7280; color: white;">
                        {{ $progress->milestone->age_range }}
                    </span>
                    
                    <div class="milestone-name">{{ $progress->milestone->name }}</div>
                    
                    @if($progress->achieved_date)
                        <div class="achievement-date">
                            <i class="bi bi-calendar-check me-1"></i>
                            Tercapai pada: {{ $progress->achieved_date->format('d M Y') }}
                        </div>
                    @endif
                    
                    @if($progress->notes)
                        <div class="achievement-notes">
                            <i class="bi bi-chat-left-quote me-1"></i>
                            "{{ $progress->notes }}"
                        </div>
                    @endif
                </div>
            @endforeach
        @endif

        <!-- Pending Milestones -->
        @if($pendingMilestones->count() > 0)
            <div class="section-header mt-5">
                <h3 class="section-title">
                    <i class="bi bi-hourglass-split me-2" style="color: #F59E0B;"></i>
                    Milestone Belum Tercapai ({{ $pendingMilestones->count() }})
                </h3>
            </div>

            @foreach($pendingMilestones as $milestone)
                <div class="milestone-card pending">
                    <span class="milestone-badge badge-pending">
                        <i class="bi bi-hourglass me-1"></i>Belum Tercapai
                    </span>
                    <span class="milestone-badge" style="background: #3B82F6; color: white;">
                        {{ $milestone->category }}
                    </span>
                    <span class="milestone-badge" style="background: #6B7280; color: white;">
                        {{ $milestone->age_range }}
                    </span>
                    
                    <div class="milestone-name">{{ $milestone->name }}</div>
                    <div class="milestone-category">{{ $milestone->description }}</div>
                </div>
            @endforeach
        @endif

        @if($completedCount == 0 && $pendingMilestones->count() == 0)
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 80px; color: #cbd5e1;"></i>
                <h4 class="mt-3">User belum memiliki tracking apapun</h4>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
