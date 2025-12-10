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

    // Admin CRUD Methods
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

        // Map age_range to min and max months
        $ageRanges = [
            '0-3 bulan' => ['min' => 0, 'max' => 3],
            '4-6 bulan' => ['min' => 4, 'max' => 6],
            '7-9 bulan' => ['min' => 7, 'max' => 9],
            '10-12 bulan' => ['min' => 10, 'max' => 12],
        ];

        $ages = $ageRanges[$validated['age_range']];
        
        // Generate unique slug
        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        
        while (Milestone::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        Milestone::create([
            'title' => $validated['name'],
            'slug' => $slug,
            'category' => $validated['category'],
            'age_range' => $validated['age_range'],
            'min_age_months' => $ages['min'],
            'max_age_months' => $ages['max'],
            'description' => $validated['description'],
            'tips' => $validated['tips'],
        ]);

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

        // Map age_range to min and max months
        $ageRanges = [
            '0-3 bulan' => ['min' => 0, 'max' => 3],
            '4-6 bulan' => ['min' => 4, 'max' => 6],
            '7-9 bulan' => ['min' => 7, 'max' => 9],
            '10-12 bulan' => ['min' => 10, 'max' => 12],
        ];

        $ages = $ageRanges[$validated['age_range']];

        // Generate unique slug
        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        
        while (Milestone::where('slug', $slug)->where('id', '!=', $milestone->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $milestone->update([
            'title' => $validated['name'],
            'slug' => $slug,
            'category' => $validated['category'],
            'age_range' => $validated['age_range'],
            'min_age_months' => $ages['min'],
            'max_age_months' => $ages['max'],
            'description' => $validated['description'],
            'tips' => $validated['tips'],
        ]);

        return redirect()->route('milestones.index')->with('success', 'Milestone berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $milestone = Milestone::findOrFail($id);
        $milestone->delete();

        return redirect()->route('milestones.index')->with('success', 'Milestone berhasil dihapus!');
    }
}
