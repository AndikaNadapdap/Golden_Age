<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Events\ArticleUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // Tampilkan daftar artikel (Public)
    public function index(Request $request)
    {
        $query = Article::published()->with('author')->latest('published_at');

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category) {
            $query->byCategory($request->category);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->paginate(12);
        $categories = Article::select('category')->distinct()->pluck('category');

        return view('articles.index', compact('articles', 'categories'));
    }

    // Tampilkan detail artikel (Public)
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
                         ->published()
                         ->with('author')
                         ->firstOrFail();

        // Increment views
        $article->incrementViews();

        // Artikel terkait
        $relatedArticles = Article::published()
                                  ->where('id', '!=', $article->id)
                                  ->where('category', $article->category)
                                  ->take(3)
                                  ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    // Tampilkan form create artikel (Admin)
    public function create()
    {
        return view('articles.create');
    }

    // Simpan artikel baru (Admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string',
            'references' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Set author instead of user_id
        // $validated['user_id'] = auth()->id(); // Commented out for now
        
        // Generate unique slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        $validated['slug'] = $slug;
        $validated['author'] = auth()->user()->name;
        $validated['is_published'] = true;
        $validated['published_at'] = now();
        
        // Auto-generate excerpt if empty
        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($request->content), 150);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        $article = Article::create($validated);

        // Trigger event untuk mengirim email ke parent
        event(new ArticleUpdated($article));

        return redirect()->route('articles.index')
                        ->with('success', 'Artikel berhasil ditambahkan dan notifikasi email telah dikirim ke orang tua!');
    }

    // Tampilkan form edit artikel (Admin)
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    // Update artikel (Admin)
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string',
            'references' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->title);
        
        // Auto-generate excerpt if empty
        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($request->content), 150);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Hapus image lama jika ada
            if ($article->image && \Storage::disk('public')->exists($article->image)) {
                \Storage::disk('public')->delete($article->image);
            }

            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        $article->update($validated);

        // Trigger event untuk mengirim email ke parent ketika artikel diupdate
        event(new ArticleUpdated($article));

        return redirect()->route('articles.index')
                        ->with('success', 'Artikel berhasil diupdate dan notifikasi email telah dikirim ke orang tua!');
    }

    // Hapus artikel (Admin)
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Hapus image jika ada
        if ($article->image && \Storage::disk('public')->exists($article->image)) {
            \Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')
                        ->with('success', 'Artikel berhasil dihapus!');
    }

    // Like/Unlike artikel
    public function like($id)
    {
        $article = Article::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        // Toggle like: jika sudah like, maka unlike
        if ($article->isLikedBy($user)) {
            $article->likedByUsers()->detach($user->id);
            $isLiked = false;
            $message = 'Like dibatalkan';
        } else {
            $article->likedByUsers()->attach($user->id);
            $isLiked = true;
            $message = 'Artikel disukai';
        }

        return response()->json([
            'success' => true,
            'likes' => $article->likedByUsers()->count(),
            'isLiked' => $isLiked,
            'message' => $message
        ]);
    }
}
