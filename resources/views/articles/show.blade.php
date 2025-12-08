<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - Paduan 1000 Hari</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #EC4899;
            --secondary-color: #5CE1E6;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .logo {
            width: 40px;
            height: 40px;
            background: var(--secondary-color);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .article-header {
            background: linear-gradient(135deg, #FCE7F3 0%, #FBCFE8 100%);
            padding: 60px 0 40px;
        }

        .article-category {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .article-title {
            font-size: 42px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .article-meta {
            display: flex;
            gap: 24px;
            color: #64748b;
            font-size: 14px;
        }

        .article-meta i {
            margin-right: 6px;
        }

        .article-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 40px;
        }

        .article-content {
            font-size: 18px;
            line-height: 1.8;
            color: #334155;
        }

        .article-content h2 {
            font-size: 28px;
            font-weight: 700;
            margin-top: 40px;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .article-content h3 {
            font-size: 24px;
            font-weight: 600;
            margin-top: 32px;
            margin-bottom: 16px;
            color: #1e293b;
        }

        .article-content p {
            margin-bottom: 20px;
        }

        .article-content ul,
        .article-content ol {
            margin-bottom: 20px;
            padding-left: 24px;
        }

        .article-content li {
            margin-bottom: 10px;
        }

        .author-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 24px;
            margin: 40px 0;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 600;
        }

        .author-info h5 {
            margin: 0 0 4px 0;
            color: #1e293b;
        }

        .author-info p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .related-articles {
            background: #f8fafc;
            padding: 60px 0;
        }

        .related-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            transition: all 0.3s;
        }

        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .related-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .related-card .card-body {
            padding: 20px;
        }

        .related-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }

        @media (max-width: 768px) {
            .article-title {
                font-size: 32px;
            }

            .article-content {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('welcome') }}">
                <div class="logo">
                    <i class="bi bi-heart-fill text-white"></i>
                </div>
                <span class="fw-bold">Paduan 1000 Hari</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
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

    <!-- Article Header -->
    <section class="article-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <span class="article-category">{{ $article->category }}</span>
                    <h1 class="article-title">{{ $article->title }}</h1>
                    <div class="article-meta">
                        <span><i class="bi bi-person"></i>{{ $article->author }}</span>
                        <span><i class="bi bi-calendar"></i>{{ $article->published_at->format('d M Y') }}</span>
                        <span><i class="bi bi-eye"></i>{{ $article->views }} views</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" 
                             alt="{{ $article->title }}" 
                             class="article-image">
                    @endif

                    <div class="article-content">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <!-- Author Box -->
                    <div class="author-box">
                        <div class="author-avatar">
                            {{ strtoupper(substr($article->author, 0, 1)) }}
                        </div>
                        <div class="author-info">
                            <h5>{{ $article->author }}</h5>
                            <p>Penulis artikel</p>
                        </div>
                    </div>

                    <!-- Share Buttons -->
                    <div class="text-center mt-4">
                        <h6 class="mb-3">Bagikan Artikel:</h6>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="#" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="#" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
    <section class="related-articles">
        <div class="container">
            <h3 class="text-center mb-4">Artikel Terkait</h3>
            <div class="row g-4">
                @foreach($relatedArticles as $related)
                    <div class="col-md-4">
                        <a href="{{ route('articles.show', $related->slug) }}" class="text-decoration-none">
                            <div class="related-card">
                                @if($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" 
                                         alt="{{ $related->title }}" 
                                         class="related-image">
                                @else
                                    <div class="related-image bg-light d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-muted" style="font-size: 40px;"></i>
                                    </div>
                                @endif
                                
                                <div class="card-body">
                                    <h5 class="related-title">{{ $related->title }}</h5>
                                    <p class="text-muted small">{{ $related->published_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
