<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    // Tampilkan daftar resep (Public)
    public function index(Request $request)
    {
        $query = Recipe::published()->with('author')->latest('published_at');

        // Filter by age range
        if ($request->has('age_range') && $request->age_range) {
            $query->byAgeRange($request->age_range);
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->byCategory($request->category);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }

        $recipes = $query->paginate(12);
        $ageRanges = Recipe::select('age_range')->distinct()->pluck('age_range');
        $categories = Recipe::select('category')->distinct()->pluck('category');

        return view('recipes.index', compact('recipes', 'ageRanges', 'categories'));
    }

    // Tampilkan detail resep (Public)
    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)
                        ->published()
                        ->with('author')
                        ->firstOrFail();

        // Increment views
        $recipe->incrementViews();

        // Resep terkait
        $relatedRecipes = Recipe::published()
                                ->where('id', '!=', $recipe->id)
                                ->where('age_range', $recipe->age_range)
                                ->take(3)
                                ->get();

        return view('recipes.show', compact('recipe', 'relatedRecipes'));
    }

    // Tampilkan form create resep (Admin)
    public function create()
    {
        return view('recipes.create');
    }

    // Simpan resep baru (Admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required',
            'instructions' => 'required',
            'age_range' => 'required|string',
            'category' => 'required|string',
            'cooking_time' => 'nullable|integer',
            'servings' => 'required|integer',
            'difficulty' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        
        // Generate unique slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        
        while (Recipe::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        $validated['slug'] = $slug;
        $validated['is_published'] = true;
        $validated['published_at'] = now();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes', 'public');
            $validated['image'] = $imagePath;
        }

        Recipe::create($validated);

        return redirect()->route('recipes.index')
                        ->with('success', 'Resep berhasil ditambahkan!');
    }

    // Tampilkan form edit resep (Admin)
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', compact('recipe'));
    }

    // Update resep (Admin)
    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required',
            'instructions' => 'required',
            'age_range' => 'required|string',
            'category' => 'required|string',
            'cooking_time' => 'nullable|integer',
            'servings' => 'required|integer',
            'difficulty' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Hapus image lama jika ada
            if ($recipe->image && \Storage::disk('public')->exists($recipe->image)) {
                \Storage::disk('public')->delete($recipe->image);
            }

            $imagePath = $request->file('image')->store('recipes', 'public');
            $validated['image'] = $imagePath;
        }

        $recipe->update($validated);

        return redirect()->route('recipes.index')
                        ->with('success', 'Resep berhasil diupdate!');
    }

    // Delete resep (Admin)
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);

        // Hapus image jika ada
        if ($recipe->image && \Storage::disk('public')->exists($recipe->image)) {
            \Storage::disk('public')->delete($recipe->image);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')
                        ->with('success', 'Resep berhasil dihapus!');
    }

    // Like/Unlike resep
    public function like($id)
    {
        $recipe = Recipe::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        // Toggle like: jika sudah like, maka unlike
        if ($recipe->isLikedBy($user)) {
            $recipe->likedByUsers()->detach($user->id);
            $isLiked = false;
            $message = 'Like dibatalkan';
        } else {
            $recipe->likedByUsers()->attach($user->id);
            $isLiked = true;
            $message = 'Resep disukai';
        }

        return response()->json([
            'success' => true,
            'likes' => $recipe->likedByUsers()->count(),
            'isLiked' => $isLiked,
            'message' => $message
        ]);
    }
}
