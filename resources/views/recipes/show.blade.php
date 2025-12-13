<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #F59E0B; --secondary-color: #5CE1E6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 0; }
        .logo { width: 45px; height: 45px; background: var(--secondary-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo i { color: white; font-size: 24px; }
        .recipe-hero { height: 400px; object-fit: cover; width: 100%; border-radius: 20px; }
        .info-badge { background: #f1f5f9; padding: 16px 24px; border-radius: 12px; text-align: center; }
        .info-badge i { font-size: 24px; color: var(--primary-color); display: block; margin-bottom: 8px; }
        .info-badge .label { font-size: 12px; color: #64748b; }
        .info-badge .value { font-size: 18px; font-weight: 700; color: #1e293b; }
        .ingredient-list { background: #fffbeb; border-left: 4px solid var(--primary-color); padding: 20px; border-radius: 8px; }
        .ingredient-list li { margin-bottom: 12px; padding-left: 8px; }
        .instruction-step { background: white; padding: 20px; border-radius: 12px; margin-bottom: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .step-number { width: 40px; height: 40px; background: linear-gradient(135deg, #FEF3C7, #FDE68A); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--primary-color); flex-shrink: 0; }
        .like-btn { background: white; border: 2px solid #e2e8f0; padding: 12px 32px; border-radius: 12px; font-weight: 600; transition: all 0.3s; }
        .like-btn:hover, .like-btn.liked { background: #FEF3C7; border-color: var(--primary-color); color: var(--primary-color); }
        .related-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .related-card img { width: 100%; height: 150px; object-fit: cover; }
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
                <li class="breadcrumb-item"><a href="{{ route('recipes.index') }}">Resep MPASI</a></li>
                <li class="breadcrumb-item active">{{ $recipe->title }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <div class="col-lg-8">
                @if($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="recipe-hero mb-4">
                @else
                    <div class="recipe-hero bg-light d-flex align-items-center justify-content-center mb-4">
                        <i class="bi bi-image text-muted" style="font-size: 80px;"></i>
                    </div>
                @endif

                <!-- Video tutorial section -->
                @if($recipe->visio)
                    <div class="mb-4">
                        <h3 class="mb-3"><i class="bi bi-play-circle me-2" style="color: var(--primary-color);"></i>Video Tutorial</h3>
                        <div class="ratio ratio-16x9" style="border-radius: 12px; overflow: hidden;">
                            <video controls preload="metadata" style="object-fit: cover;">
                                <source src="{{ asset('storage/' . $recipe->visio) }}" type="video/mp4">
                                Browser Anda tidak mendukung video HTML5.
                            </video>
                        </div>
                        @if($recipe->video_duration)
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>Durasi: {{ $recipe->formatted_duration }}
                            </small>
                        @endif
                    </div>
                @endif

                <h1 class="fw-bold mb-3">{{ $recipe->title }}</h1>
                <p class="text-muted mb-4">{{ $recipe->description }}</p>

                <div class="row g-3 mb-5">
                    <div class="col-6 col-md-3">
                        <div class="info-badge">
                            <i class="bi bi-person-badge"></i>
                            <div class="label">Usia</div>
                            <div class="value">{{ $recipe->age_range }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="info-badge">
                            <i class="bi bi-clock"></i>
                            <div class="label">Waktu</div>
                            <div class="value">{{ $recipe->cooking_time }} menit</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="info-badge">
                            <i class="bi bi-egg-fried"></i>
                            <div class="label">Porsi</div>
                            <div class="value">{{ $recipe->servings }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="info-badge">
                            <i class="bi bi-speedometer2"></i>
                            <div class="label">Kesulitan</div>
                            <div class="value">{{ $recipe->difficulty }}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h3 class="fw-bold mb-3"><i class="bi bi-basket me-2" style="color: var(--primary-color);"></i>Bahan-bahan</h3>
                    <ul class="ingredient-list">
                        @foreach($recipe->ingredientsArray as $ingredient)
                            <li>{{ $ingredient }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-5">
                    <h3 class="fw-bold mb-3"><i class="bi bi-list-ol me-2" style="color: var(--primary-color);"></i>Cara Membuat</h3>
                    @foreach($recipe->instructionsArray as $index => $instruction)
                        <div class="instruction-step d-flex gap-3">
                            <div class="step-number">{{ $index + 1 }}</div>
                            <p class="mb-0 flex-grow-1">{{ $instruction }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex align-items-center gap-3 mb-5">
                    <button onclick="likeRecipe({{ $recipe->id }})" class="like-btn" id="likeBtn">
                        <i class="bi bi-heart me-2"></i><span id="likeCount">{{ $recipe->likes }}</span> Suka
                    </button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Tentang Penulis</h5>
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #5CE1E6, #2E90FA); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-person-fill text-white fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $recipe->author->name }}</div>
                                <small class="text-muted">{{ $recipe->published_at->format('d M Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                @if($relatedRecipes->count() > 0)
                    <h5 class="fw-bold mb-3">Resep Terkait</h5>
                    @foreach($relatedRecipes as $related)
                        <a href="{{ route('recipes.show', $related->slug) }}" class="text-decoration-none">
                            <div class="related-card mb-3">
                                @if($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}">
                                @else
                                    <div style="width: 100%; height: 150px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-image text-muted fs-3"></i>
                                    </div>
                                @endif
                                <div class="p-3">
                                    <h6 class="fw-bold text-dark mb-1">{{ $related->title }}</h6>
                                    <small class="text-muted">{{ $related->age_range }} • {{ $related->cooking_time }} menit</small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function likeRecipe(id) {
            fetch(`/recipes/${id}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('likeCount').textContent = data.likes;
                    document.getElementById('likeBtn').classList.add('liked');
                }
            });
        }
    </script>
</body>
</html>
