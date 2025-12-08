<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MilestoneController extends Controller
{
    public function index(Request $request)
    {
        $query = Milestone::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('age_range')) {
            $query->where('age_range', $request->age_range);
        }

        $milestones = $query->orderBy('age_range')->orderBy('category')->paginate(12);

        return view('milestones.index', compact('milestones'));
    }

    public function show($slug)
    {
        $milestone = Milestone::where('slug', $slug)->firstOrFail();
        return view('milestones.show', compact('milestone'));
    }

<<<<<<< HEAD
    // Admin CRUD Methods
=======
    // Admin CRUD Methods 
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
    public function create()
    {
        return view('milestones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Motorik Kasar,Motorik Halus,Kognitif,Bahasa,Sosial-Emosional',
            'age_range' => 'required|in:0-3 bulan,4-6 bulan,7-9 bulan,10-12 bulan',
            'description' => 'required|string',
            'tips' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Milestone::create($validated);

        return redirect()->route('milestones.index')->with('success', 'Milestone berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $milestone = Milestone::findOrFail($id);
        return view('milestones.edit', compact('milestone'));
    }

    public function update(Request $request, $id)
    {
        $milestone = Milestone::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Motorik Kasar,Motorik Halus,Kognitif,Bahasa,Sosial-Emosional',
            'age_range' => 'required|in:0-3 bulan,4-6 bulan,7-9 bulan,10-12 bulan',
            'description' => 'required|string',
            'tips' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $milestone->update($validated);

        return redirect()->route('milestones.index')->with('success', 'Milestone berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $milestone = Milestone::findOrFail($id);
        $milestone->delete();

        return redirect()->route('milestones.index')->with('success', 'Milestone berhasil dihapus!');
    }
}
