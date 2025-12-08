<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
            'excerpt' => 'required|string|max:500',
            'category' => 'required|string',
            'author' => 'required|string|max:255',
            'references' => 'nullable|string',
            'published_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        Article::create($validated);

        return redirect()->route('articles.index')
                        ->with('success', 'Artikel berhasil ditambahkan!');
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
            'excerpt' => 'required|string|max:500',
            'category' => 'required|string',
            'author' => 'required|string|max:255',
            'references' => 'nullable|string',
            'published_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->title);

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

        return redirect()->route('articles.index')
                        ->with('success', 'Artikel berhasil diupdate!');
    }

<<<<<<< HEAD
    // Hapus artikel (Admin)
=======
    // Hapus artikel (Admin) 
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
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
<<<<<<< HEAD
}
=======
}
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
