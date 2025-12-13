<?php

namespace App\Http\Controllers;

use App\Models\Stimulation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StimulationController extends Controller
{
    public function index(Request $request)
    {
        $query = Stimulation::query();

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter by age range
        if ($request->has('age_range') && $request->age_range != '') {
            $query->where('age_range', $request->age_range);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $stimulations = $query->latest()->paginate(9);

        return view('stimulations.index', compact('stimulations'));
    }

    public function show($slug)
    {
        $stimulation = Stimulation::where('slug', $slug)->firstOrFail();
        
        // Get related stimulations
        $relatedStimulations = Stimulation::where('category', $stimulation->category)
            ->where('id', '!=', $stimulation->id)
            ->limit(3)
            ->get();
        
        return view('stimulations.show', compact('stimulation', 'relatedStimulations'));
    }

    // Tampilkan form create stimulasi (Admin)
    public function create()
    {
        return view('stimulations.create');
    }

    // Simpan stimulasi baru (Admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'age_range' => 'required|string',
            'materials' => 'nullable|string',
            'instructions' => 'required|string',
            'benefits' => 'nullable|string',
            'duration' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visio' => 'nullable|file|mimes:mp4,mov,avi,webm|max:51200',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['age_range'] = $request->input('age_range', '0-3 bulan');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stimulations', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle visio upload
        if ($request->hasFile('visio')) {
            $visioPath = $request->file('visio')->store('stimulations/visio', 'public');
            $validated['visio'] = $visioPath;
        }

        Stimulation::create($validated);

        return redirect()->route('stimulations.index')
                        ->with('success', 'Stimulasi berhasil ditambahkan!');
    }

    // Tampilkan form edit stimulasi (Admin)
    public function edit($id)
    {
        $stimulation = Stimulation::findOrFail($id);
        return view('stimulations.edit', compact('stimulation'));
    }

    // Update stimulasi (Admin)
    public function update(Request $request, $id)
    {
        $stimulation = Stimulation::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'age_range' => 'required|string',
            'materials' => 'nullable|string',
            'instructions' => 'required|string',
            'benefits' => 'nullable|string',
            'duration' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200',
            'remove_video' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['age_range'] = $request->input('age_range', '0-3 bulan');

        // Handle image upload with Cloudinary
        if ($request->hasFile('image')) {
            try {
                // Delete old image from Cloudinary if exists
                if ($stimulation->cloudinary_public_id) {
                    $this->cloudinary->deleteImage($stimulation->cloudinary_public_id);
                }

                $result = $this->cloudinary->uploadImage($request->file('image'), 'stimulations');
                $validated['cloudinary_public_id'] = $result['public_id'];
                $validated['cloudinary_url'] = $result['secure_url'];
                $validated['image'] = $result['secure_url'];
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Gagal mengupload gambar: ' . $e->getMessage()]);
            }
        }

        // Handle video removal
        if ($request->input('remove_video')) {
            if ($stimulation->video_public_id) {
                try {
                    $this->cloudinary->deleteImage($stimulation->video_public_id);
                } catch (\Exception $e) {
                    // Log error but continue
                }
            }
            $validated['video_url'] = null;
            $validated['video_public_id'] = null;
            $validated['video_duration'] = null;
        }

        // Handle video upload with Cloudinary
        if ($request->hasFile('video')) {
            try {
                // Delete old video from Cloudinary if exists
                if ($stimulation->video_public_id) {
                    $this->cloudinary->deleteImage($stimulation->video_public_id);
                }

                $result = $this->cloudinary->uploadVideo($request->file('video'), 'stimulations/videos');
                $validated['video_public_id'] = $result['public_id'];
                $validated['video_url'] = $result['secure_url'];
                $validated['video_duration'] = $result['duration'] ?? null;
            } catch (\Exception $e) {
                return back()->withErrors(['video' => 'Gagal mengupload video: ' . $e->getMessage()]);
            }
        }

        $stimulation->update($validated);

        return redirect()->route('stimulations.index')
                        ->with('success', 'Stimulasi berhasil diupdate!');
    }

    // Delete stimulasi (Admin)
    public function destroy($id)
    {
        $stimulation = Stimulation::findOrFail($id);

        // Hapus image jika ada
        if ($stimulation->image && Storage::disk('public')->exists($stimulation->image)) {
            Storage::disk('public')->delete($stimulation->image);
        }

        $stimulation->delete();

        return redirect()->route('stimulations.index')
                        ->with('success', 'Stimulasi berhasil dihapus!');
    }

    // Like/Unlike stimulasi
    public function like($id)
    {
        $stimulation = Stimulation::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        // Toggle like: jika sudah like, maka unlike
        if ($stimulation->isLikedBy($user)) {
            $stimulation->likedByUsers()->detach($user->id);
            $isLiked = false;
            $message = 'Like dibatalkan';
        } else {
            $stimulation->likedByUsers()->attach($user->id);
            $isLiked = true;
            $message = 'Stimulasi disukai';
        }

        return response()->json([
            'success' => true,
            'likes' => $stimulation->likedByUsers()->count(),
            'isLiked' => $isLiked,
            'message' => $message
        ]);
    }
}
