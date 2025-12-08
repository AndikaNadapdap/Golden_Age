<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $discussion->title }} - Forum Diskusi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #10B981; --secondary-color: #5CE1E6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 0; }
        .logo { width: 45px; height: 45px; background: var(--secondary-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo i { color: white; font-size: 24px; }
        .discussion-header { background: white; border-radius: 16px; padding: 32px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); margin-bottom: 24px; }
        .discussion-badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; margin-right: 8px; }
        .badge-kehamilan { background: #FEE2E2; color: #DC2626; }
        .badge-mpasi { background: #FEF3C7; color: #F59E0B; }
        .badge-kesehatan { background: #DBEAFE; color: #2563EB; }
        .badge-perkembangan { background: #E0E7FF; color: #6366F1; }
        .badge-lainnya { background: #F3F4F6; color: #6B7280; }
        .author-info { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .avatar { width: 50px; height: 50px; background: linear-gradient(135deg, #5CE1E6, #2E90FA); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 20px; }
        .discussion-content { font-size: 16px; line-height: 1.8; color: #334155; margin: 24px 0; }
        .stats-row { display: flex; gap: 24px; padding: 16px 0; border-top: 1px solid #e2e8f0; color: #64748b; }
        .like-btn { background: white; border: 2px solid #e2e8f0; padding: 10px 24px; border-radius: 10px; font-weight: 600; transition: all 0.3s; }
        .like-btn:hover { background: #D1FAE5; border-color: var(--primary-color); color: var(--primary-color); }
        .reply-section { background: white; border-radius: 16px; padding: 32px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); margin-bottom: 24px; }
        .reply-card { padding: 20px; border-bottom: 1px solid #f1f5f9; }
        .reply-card:last-child { border-bottom: none; }
        .reply-avatar { width: 40px; height: 40px; background: linear-gradient(135deg, #34D399, #10B981); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; }
        .reply-form { background: #f8fafc; padding: 20px; border-radius: 12px; margin-top: 24px; }
        .reply-form textarea { border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px; }
        .reply-form textarea:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(16,185,129,0.1); }
        .btn-submit { background: var(--primary-color); color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; }
        .btn-submit:hover { background: #059669; }
        .closed-banner { background: #FEE2E2; color: #DC2626; padding: 12px 20px; border-radius: 8px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
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
                <li class="breadcrumb-item active">{{ Str::limit($discussion->title, 50) }}</li>
            </ol>
        </nav>

        @if($discussion->is_closed)
            <div class="closed-banner">
                <i class="bi bi-lock-fill"></i>
                <span>Diskusi ini telah ditutup. Tidak dapat menambahkan balasan baru.</span>
            </div>
        @endif

        <div class="discussion-header">
            <span class="discussion-badge badge-{{ strtolower($discussion->category) }}">{{ $discussion->category }}</span>
            
            <h1 class="fw-bold mt-3 mb-4">{{ $discussion->title }}</h1>
            
            <div class="author-info">
                <div class="avatar">{{ substr($discussion->author->name, 0, 1) }}</div>
                <div>
                    <div class="fw-bold">{{ $discussion->author->name }}</div>
                    <small class="text-muted">{{ $discussion->created_at->format('d M Y, H:i') }} • {{ $discussion->created_at->diffForHumans() }}</small>
                </div>
            </div>

            <div class="discussion-content">
                {!! nl2br(e($discussion->content)) !!}
            </div>

            <div class="stats-row">
                <span><i class="bi bi-eye me-2"></i>{{ $discussion->views }} views</span>
                <span><i class="bi bi-chat me-2"></i>{{ $discussion->replies_count }} balasan</span>
                <button onclick="likeDiscussion({{ $discussion->id }})" class="like-btn border-0 bg-transparent p-0" id="likeBtn">
                    <i class="bi bi-heart me-1"></i><span id="likeCount">{{ $discussion->likes }}</span>
                </button>
            </div>

            @auth
                <div class="mt-3 d-flex gap-2">
                    @if(auth()->id() == $discussion->user_id && !$discussion->is_closed)
                        <form action="{{ route('discussions.close', $discussion->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-lock me-1"></i>Tutup Diskusi
                            </button>
                        </form>
                    @endif
                    @if(auth()->id() == $discussion->user_id || auth()->user()->role === 'admin')
                        <form action="{{ route('discussions.destroy', $discussion->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus diskusi ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash me-1"></i>Hapus Diskusi
                            </button>
                        </form>
                    @endif
                </div>
            @endauth
        </div>

        <div class="reply-section">
            <h4 class="fw-bold mb-4"><i class="bi bi-chat-left-text me-2" style="color: var(--primary-color);"></i>{{ $discussion->replies_count }} Balasan</h4>
            
            @if($discussion->replies->count() > 0)
                @foreach($discussion->replies as $reply)
                    <div class="reply-card">
                        <div class="d-flex gap-3">
                            <div class="reply-avatar">{{ substr($reply->author->name, 0, 1) }}</div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <strong>{{ $reply->author->name }}</strong>
                                        <small class="text-muted ms-2">{{ $reply->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button onclick="likeReply({{ $reply->id }})" class="btn btn-sm btn-light" id="replyLikeBtn{{ $reply->id }}">
                                            <i class="bi bi-heart me-1"></i><span id="replyLikeCount{{ $reply->id }}">{{ $reply->likes }}</span>
                                        </button>
                                        @auth
                                            @if(auth()->id() === $reply->user_id)
                                                <form action="{{ route('discussions.reply.destroy', $reply->id) }}" method="POST" 
                                                      onsubmit="return confirm('Yakin ingin menghapus balasan ini?')" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                <p class="mb-0">{!! nl2br(e($reply->content)) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-chat-left-dots" style="font-size: 48px;"></i>
                    <p class="mt-2">Belum ada balasan. Jadilah yang pertama!</p>
                </div>
            @endif

            @auth
                @if(!$discussion->is_closed)
                    <div class="reply-form">
                        <h5 class="fw-bold mb-3">Tambahkan Balasan</h5>
                        <form action="{{ route('discussions.reply', $discussion->id) }}" method="POST">
                            @csrf
                            <textarea name="content" class="form-control mb-3" rows="4" placeholder="Tulis balasan Anda..." required></textarea>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send me-2"></i>Kirim Balasan
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <div class="reply-form text-center">
                    <p class="mb-3">Silakan <a href="{{ route('login') }}">masuk</a> untuk menambahkan balasan</p>
                </div>
            @endauth
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function likeDiscussion(id) {
            fetch(`/discussions/${id}/like`, {
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
                }
            });
        }

        function likeReply(id) {
            fetch(`/discussions/replies/${id}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('replyLikeCount' + id).textContent = data.likes;
                }
            });
        }
    </script>
</body>
</html>
