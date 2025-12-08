<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $milestone->title }} - Tracker Sensorik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #5CE1E6;
            --secondary-color: #38BDF8;
        }

        body {
            background: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
<<<<<<< HEAD
k
=======

>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
        }

        .logo {
            width: 45px;
            height: 45px;
            background: var(--primary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-section {
            background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 100%);
            padding: 60px 0 40px;
        }

        .category-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.3);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .milestone-card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .tips-box {
            background: #FEF3C7;
            border-left: 4px solid #F59E0B;
            padding: 20px;
            border-radius: 8px;
            margin: 24px 0;
        }

        .achievement-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: #F0F9FF;
            border-radius: 12px;
            border: 2px dashed #0EA5E9;
            cursor: pointer;
            transition: all 0.3s;
        }

        .achievement-toggle:hover {
            background: #E0F2FE;
            border-color: #0284C7;
        }

        .achievement-toggle.achieved {
            background: #DCFCE7;
            border: 2px solid #22C55E;
        }

        .checkbox-custom {
            width: 28px;
            height: 28px;
            cursor: pointer;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            transition: all 0.3s;
            height: 100%;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .content-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .article-image {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        }

        .recipe-image {
            background: linear-gradient(135deg, #FED7AA 0%, #FDBA74 100%);
        }

        .stimulation-image {
            background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
        }

        .category-tag {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .article-tag {
            background: #FDE68A;
            color: #92400E;
        }

        .recipe-tag {
            background: #FED7AA;
            color: #9A3412;
        }

        .stimulation-tag {
            background: #BFDBFE;
            color: #1E40AF;
        }

        .notes-section {
            background: #F8FAFC;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: white;
            border: 2px solid #E2E8F0;
            border-radius: 10px;
            color: #64748B;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: #F8FAFC;
            border-color: #CBD5E1;
            color: #475569;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <div class="logo">
                    <i class="bi bi-heart-fill text-white"></i>
                </div>
                <span class="fw-bold">Paduan 1000 Hari</span>
            </a>
            <a href="{{ route('tracker.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Tracker
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <span class="category-badge">
                <i class="bi bi-tag-fill me-2"></i>{{ $milestone->category }}
            </span>
            <h1 class="fw-bold mb-3">{{ $milestone->title }}</h1>
            <p class="lead mb-0">
                <i class="bi bi-calendar-heart me-2"></i>{{ $milestone->age_range }}
            </p>
        </div>
    </section>

    <!-- Milestone Detail -->
    <section class="pb-5">
        <div class="container">
            <div class="milestone-card">
                <!-- Achievement Toggle -->
                @auth
                <form action="{{ route('tracker.toggle', $milestone->id) }}" method="POST" id="achievementForm">
                    @csrf
                    <div class="achievement-toggle {{ $isAchieved ? 'achieved' : '' }}" onclick="document.getElementById('achievementForm').submit()">
                        <input type="checkbox" 
                               class="checkbox-custom" 
                               {{ $isAchieved ? 'checked' : '' }}
                               onclick="event.stopPropagation()">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">
                                @if($isAchieved)
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Milestone Tercapai!
                                @else
                                    <i class="bi bi-circle me-2"></i>
                                    Tandai sebagai tercapai
                                @endif
                            </h6>
                            <p class="text-muted small mb-0">
                                @if($isAchieved && $userProgress)
                                    Dicapai pada {{ $userProgress->achieved_date ? $userProgress->achieved_date->format('d M Y') : '-' }}
                                @else
                                    Klik untuk menandai milestone ini sudah dicapai
                                @endif
                            </p>
                        </div>
                    </div>
                </form>
                @endauth

                <!-- Description -->
                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Deskripsi Milestone</h5>
                    <p class="text-muted">{{ $milestone->description }}</p>
                </div>

                <!-- Tips Box -->
                @if($milestone->tips)
                <div class="tips-box">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-lightbulb text-warning me-2"></i>
                        Tips Stimulasi
                    </h6>
                    <p class="mb-0">{{ $milestone->tips }}</p>
                </div>
                @endif

                <!-- Notes Section -->
                @auth
                <div class="notes-section">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-pencil-square me-2"></i>
                        Catatan Pribadi
                    </h6>
                    <form action="{{ route('tracker.notes', $milestone->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="notes" 
                                      class="form-control" 
                                      rows="3" 
                                      placeholder="Tulis catatan tentang perkembangan anak Anda...">{{ $userProgress ? $userProgress->notes : '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan Catatan
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </section>

    <!-- Related Content -->
    <section class="py-5 bg-white">
        <div class="container">
            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
            <div class="mb-5">
                <h3 class="fw-bold mb-4">
                    <i class="bi bi-journal-text me-2 text-warning"></i>
                    Artikel Terkait
                </h3>
                <p class="text-muted mb-4">Baca artikel yang mendukung perkembangan milestone ini</p>
                <div class="row g-4">
                    @foreach($relatedArticles as $article)
                    <div class="col-md-4">
                        <a href="{{ route('articles.show', $article->slug) }}" class="text-decoration-none">
                            <div class="content-card">
                                <div class="position-relative">
                                    <div class="content-image article-image">
                                        <i class="bi bi-journal-text" style="font-size: 48px; color: #F59E0B;"></i>
                                    </div>
                                    <span class="category-tag article-tag">{{ $article->category }}</span>
                                </div>
                                <div class="p-3">
                                    <h6 class="fw-bold text-dark mb-2">{{ $article->title }}</h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($article->excerpt, 80) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Related Recipes -->
            @if($relatedRecipes->count() > 0)
            <div class="mb-5">
                <h3 class="fw-bold mb-4">
                    <i class="bi bi-egg-fried me-2 text-warning"></i>
                    Resep MPASI Terkait
                </h3>
                <p class="text-muted mb-4">Nutrisi yang tepat untuk mendukung perkembangan</p>
                <div class="row g-4">
                    @foreach($relatedRecipes as $recipe)
                    <div class="col-md-4">
                        <a href="{{ route('recipes.show', $recipe->slug) }}" class="text-decoration-none">
                            <div class="content-card">
                                <div class="position-relative">
                                    <div class="content-image recipe-image">
                                        <i class="bi bi-egg-fried" style="font-size: 48px; color: #F97316;"></i>
                                    </div>
                                    <span class="category-tag recipe-tag">{{ $recipe->age_range }}</span>
                                </div>
                                <div class="p-3">
                                    <h6 class="fw-bold text-dark mb-2">{{ $recipe->title }}</h6>
                                    <p class="text-muted small mb-2">{{ Str::limit($recipe->description, 60) }}</p>
                                    <div class="d-flex justify-content-between text-muted" style="font-size: 13px;">
                                        <span><i class="bi bi-clock me-1"></i>{{ $recipe->cooking_time }} menit</span>
                                        <span><i class="bi bi-people me-1"></i>{{ $recipe->servings }} porsi</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Related Stimulations -->
            @if($relatedStimulations->count() > 0)
            <div>
                <h3 class="fw-bold mb-4">
                    <i class="bi bi-puzzle me-2 text-primary"></i>
                    Stimulasi & Permainan Terkait
                </h3>
                <p class="text-muted mb-4">Aktivitas yang dapat membantu mencapai milestone ini</p>
                <div class="row g-4">
                    @foreach($relatedStimulations as $stimulation)
                    <div class="col-md-4">
                        <a href="{{ route('stimulations.show', $stimulation->slug) }}" class="text-decoration-none">
                            <div class="content-card">
                                <div class="position-relative">
                                    <div class="content-image stimulation-image">
                                        <i class="bi bi-puzzle" style="font-size: 48px; color: #3B82F6;"></i>
                                    </div>
                                    <span class="category-tag stimulation-tag">{{ $stimulation->category }}</span>
                                </div>
                                <div class="p-3">
                                    <h6 class="fw-bold text-dark mb-2">{{ $stimulation->title }}</h6>
                                    <p class="text-muted small mb-2">{{ Str::limit($stimulation->description, 60) }}</p>
                                    <div class="d-flex justify-content-between text-muted" style="font-size: 13px;">
                                        <span><i class="bi bi-clock me-1"></i>{{ $stimulation->duration }} menit</span>
                                        <span><i class="bi bi-calendar me-1"></i>{{ $stimulation->age_range }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($relatedArticles->count() == 0 && $relatedRecipes->count() == 0 && $relatedStimulations->count() == 0)
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 64px; color: #CBD5E1;"></i>
                <p class="text-muted mt-3">Belum ada konten terkait untuk milestone ini</p>
            </div>
            @endif
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
