<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleCloudinaryController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->cloudinary = $cloudinary;
    }

    /**
     * Store artikel dengan upload ke Cloudinary
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // max 5MB
        ], [
            'title.required' => 'Judul artikel wajib diisi',
            'content.required' => 'Konten artikel wajib diisi',
            'category.required' => 'Kategori wajib dipilih',
            'image.required' => 'Gambar wajib diupload',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar: JPEG, PNG, JPG, GIF, WebP',
            'image.max' => 'Ukuran maksimal 5MB',
        ]);

        try {
            // Upload ke Cloudinary
            $uploadResult = $this->cloudinary->uploadWithThumbnail(
                $request->file('image'),
                'golden_age/articles' // folder di Cloudinary
            );

            $article = Article::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'category' => $validated['category'],
                'image' => $uploadResult['thumbnail_url'], // Thumbnail untuk listing
                'cloudinary_public_id' => $uploadResult['public_id'],
                'cloudinary_url' => $uploadResult['url'], // Full resolution
                'author_id' => Auth::id(),
            ]);

            return redirect()->route('articles.show', $article->slug)
                ->with('success', '✅ Artikel berhasil dipublikasikan!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', '❌ Gagal upload gambar: ' . $e->getMessage());
        }
    }

    /**
     * Update artikel dengan upload gambar baru ke Cloudinary
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        try {
            // Jika ada gambar baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama dari Cloudinary
                if ($article->cloudinary_public_id) {
                    $this->cloudinary->deleteImage($article->cloudinary_public_id);
                }

                // Upload gambar baru
                $uploadResult = $this->cloudinary->uploadWithThumbnail(
                    $request->file('image'),
                    'golden_age/articles'
                );

                $validated['image'] = $uploadResult['thumbnail_url'];
                $validated['cloudinary_public_id'] = $uploadResult['public_id'];
                $validated['cloudinary_url'] = $uploadResult['url'];
            }

            $validated['slug'] = Str::slug($validated['title']);
            $article->update($validated);

            return redirect()->route('articles.show', $article->slug)
                ->with('success', '✅ Artikel berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', '❌ Gagal update artikel: ' . $e->getMessage());
        }
    }

    /**
     * Hapus artikel dan gambar dari Cloudinary
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        try {
            // Hapus gambar dari Cloudinary
            if ($article->cloudinary_public_id) {
                $this->cloudinary->deleteImage($article->cloudinary_public_id);
            }

            $article->delete();

            return redirect()->route('articles.index')
                ->with('success', '✅ Artikel berhasil dihapus!');

        } catch (\Exception $e) {
            return back()->with('error', '❌ Gagal hapus artikel: ' . $e->getMessage());
        }
    }
}
