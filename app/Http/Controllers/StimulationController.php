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
        ]);

        $validated['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stimulations', 'public');
            $validated['image'] = $imagePath;
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

        // Debug: cek apakah file diterima
        \Log::info('Has File Image: ' . ($request->hasFile('image') ? 'YES' : 'NO'));
        if ($request->hasFile('image')) {
            \Log::info('File Name: ' . $request->file('image')->getClientOriginalName());
            \Log::info('File Size: ' . $request->file('image')->getSize());
        }

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
        ]);

        $validated['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Hapus image lama jika ada
            if ($stimulation->image && Storage::disk('public')->exists($stimulation->image)) {
                Storage::disk('public')->delete($stimulation->image);
            }

            $imagePath = $request->file('image')->store('stimulations', 'public');
            $validated['image'] = $imagePath;
            
            \Log::info('Image saved to: ' . $imagePath);
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

    public function like($id)
    {
        $stimulation = Stimulation::findOrFail($id);
        $stimulation->increment('likes');
        $stimulation->refresh();
        
        return response()->json([
            'success' => true,
            'likes' => $stimulation->likes
        ]);
    }
}
