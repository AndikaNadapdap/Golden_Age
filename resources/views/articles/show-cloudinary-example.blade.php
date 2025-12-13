{{-- Example: Tampilan Artikel dengan Cloudinary --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <article class="article-detail">
                {{-- Featured Image dari Cloudinary --}}
                @if($article->cloudinary_url)
                    <div class="article-image mb-4">
                        <img src="{{ $article->cloudinary_url }}" 
                             alt="{{ $article->title }}" 
                             class="img-fluid rounded shadow-sm"
                             loading="lazy">
                    </div>
                @endif

                {{-- Article Header --}}
                <header class="article-header mb-4">
                    <h1 class="article-title display-4 fw-bold mb-3">{{ $article->title }}</h1>
                    
                    <div class="article-meta d-flex align-items-center gap-3 text-muted">
                        <span>
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $article->author->name }}
                        </span>
                        <span>
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $article->created_at->format('d M Y') }}
                        </span>
                        <span class="badge bg-primary">{{ $article->category }}</span>
                    </div>
                </header>

                {{-- Article Content --}}
                <div class="article-content">
                    {!! nl2br(e($article->content)) !!}
                </div>

                {{-- Action Buttons --}}
                @auth
                    @if(auth()->user()->id === $article->author_id || auth()->user()->role === 'admin')
                        <div class="article-actions mt-4 pt-4 border-top">
                            <a href="{{ route('articles.edit', $article->slug) }}" 
                               class="btn btn-warning">
                                <i class="bi bi-pencil-square me-1"></i> Edit Artikel
                            </a>
                            <form action="{{ route('articles.destroy', $article->slug) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </article>

            {{-- Related Articles with Cloudinary Thumbnails --}}
            @if($relatedArticles->count() > 0)
                <section class="related-articles mt-5 pt-5 border-top">
                    <h3 class="mb-4">Artikel Terkait</h3>
                    <div class="row g-4">
                        @foreach($relatedArticles as $related)
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm">
                                    {{-- Cloudinary Thumbnail --}}
                                    @if($related->image)
                                        <img src="{{ $related->image }}" 
                                             class="card-img-top" 
                                             alt="{{ $related->title }}"
                                             style="height: 200px; object-fit: cover;"
                                             loading="lazy">
                                    @endif
                                    
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $related->title }}</h5>
                                        <p class="card-text text-muted small">
                                            {{ Str::limit(strip_tags($related->content), 100) }}
                                        </p>
                                        <a href="{{ route('articles.show', $related->slug) }}" 
                                           class="btn btn-sm btn-primary">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</div>

<style>
.article-image img {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
}

.article-content p {
    margin-bottom: 1.5rem;
}
</style>
@endsection
