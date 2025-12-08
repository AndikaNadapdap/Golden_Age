<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Milestone;
use App\Models\ChildProgress;
use App\Models\Article;
use App\Models\Recipe;
use App\Models\Stimulation;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    public function index(Request $request)
    {
        $query = Milestone::query();

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter by age range
        if ($request->has('age_range') && $request->age_range != '') {
            $query->where('age_range', $request->age_range);
        }

        $milestones = $query->orderBy('min_age_months')->orderBy('category')->get();

        // Group by age range
        $groupedMilestones = $milestones->groupBy('age_range');

        // Get user's progress if authenticated
        $userProgress = [];
        if (auth()->check()) {
            $progress = ChildProgress::where('user_id', auth()->id())->get();
            foreach ($progress as $p) {
                $userProgress[$p->milestone_id] = $p;
            }
        }

        return view('tracker.index', compact('groupedMilestones', 'userProgress'));
    }

    public function toggleProgress(Request $request, $milestoneId)
    {
        $progress = ChildProgress::where('user_id', auth()->id())
            ->where('milestone_id', $milestoneId)
            ->first();

        if ($progress) {
            // Toggle achievement
            $progress->is_achieved = !$progress->is_achieved;
            $progress->achieved_date = $progress->is_achieved ? now() : null;
            $progress->save();
        } else {
            // Create new progress
            ChildProgress::create([
                'user_id' => auth()->id(),
                'milestone_id' => $milestoneId,
                'is_achieved' => true,
                'achieved_date' => now(),
            ]);
        }

        return back()->with('success', 'Progress berhasil diperbarui!');
    }

    public function updateNotes(Request $request, $milestoneId)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500'
        ]);

        $progress = ChildProgress::where('user_id', auth()->id())
            ->where('milestone_id', $milestoneId)
            ->first();

        if ($progress) {
            $progress->notes = $request->notes;
            $progress->save();
        } else {
            ChildProgress::create([
                'user_id' => auth()->id(),
                'milestone_id' => $milestoneId,
                'is_achieved' => false,
                'notes' => $request->notes,
            ]);
        }

        return back()->with('success', 'Catatan berhasil disimpan!');
    }

    // Admin monitoring progress semua user
    public function progress()
    {
        $users = User::where('role', 'user')
            ->withCount(['childProgress as milestones_completed'])
            ->with(['childProgress' => function($query) {
                $query->latest('achieved_date')->limit(1);
            }])
            ->orderBy('name')
            ->paginate(15);

        $totalMilestones = Milestone::count();
        $totalUsers = User::where('role', 'user')->count();
        
        // Calculate average progress
        $usersWithProgress = User::where('role', 'user')
            ->withCount('childProgress')
            ->get();
        
        $averageProgress = $usersWithProgress->avg(function($user) use ($totalMilestones) {
            return $totalMilestones > 0 ? ($user->child_progress_count / $totalMilestones) * 100 : 0;
        });

        return view('admin.tracker.progress', compact('users', 'totalMilestones', 'totalUsers', 'averageProgress'));
    }

    // Detail progress individual user
    public function detail($userId)
    {
        $user = User::with(['childProgress.milestone'])->findOrFail($userId);
        
        $completedMilestones = $user->childProgress;
        $completedMilestoneIds = $completedMilestones->pluck('milestone_id')->toArray();
        
        $pendingMilestones = Milestone::whereNotIn('id', $completedMilestoneIds)
            ->orderBy('age_range')
            ->orderBy('category')
            ->get();
        
        $totalMilestones = Milestone::count();
        $completedCount = $completedMilestones->count();
        $progressPercentage = $totalMilestones > 0 ? round(($completedCount / $totalMilestones) * 100) : 0;

        return view('admin.tracker.detail', compact('user', 'completedMilestones', 'pendingMilestones', 'totalMilestones', 'completedCount', 'progressPercentage'));
    }

    // Show milestone detail with related content
    public function show($milestoneId)
    {
        $milestone = Milestone::findOrFail($milestoneId);
        
        // Check if user has achieved this milestone
        $userProgress = null;
        $isAchieved = false;
        
        if (auth()->check()) {
            $userProgress = ChildProgress::where('user_id', auth()->id())
                ->where('milestone_id', $milestoneId)
                ->first();
            $isAchieved = $userProgress ? $userProgress->is_achieved : false;
        }

        // Map milestone category to content categories
        $categoryMapping = [
            'Motorik Kasar' => ['article' => 'Perkembangan', 'stimulation' => 'Motorik Kasar'],
            'Motorik Halus' => ['article' => 'Perkembangan', 'stimulation' => 'Motorik Halus'],
            'Kognitif' => ['article' => 'Perkembangan', 'stimulation' => 'Kognitif'],
            'Bahasa' => ['article' => 'Perkembangan', 'stimulation' => 'Bahasa'],
            'Sosial-Emosional' => ['article' => 'Perkembangan', 'stimulation' => 'Sosial-Emosional'],
        ];

        $mapping = $categoryMapping[$milestone->category] ?? ['article' => 'Perkembangan', 'stimulation' => 'Kognitif'];

        // Get related articles
        $relatedArticles = Article::where('is_published', true)
            ->where('category', $mapping['article'])
            ->latest()
            ->take(3)
            ->get();

        // Get related recipes based on age range
        $ageToRecipeMap = [
            'Usia 0-3 bulan' => '6-8 bulan',
            'Usia 4-6 bulan' => '6-8 bulan',
            'Usia 7-9 bulan' => '9-11 bulan',
            'Usia 10-12 bulan' => '12+ bulan',
        ];
        
        $recipeAge = $ageToRecipeMap[$milestone->age_range] ?? '6-8 bulan';
        
        $relatedRecipes = Recipe::where('age_range', $recipeAge)
            ->latest()
            ->take(3)
            ->get();

        // Get related stimulations
        $relatedStimulations = Stimulation::where('category', $mapping['stimulation'])
            ->latest()
            ->take(3)
            ->get();

        return view('tracker.show', compact(
            'milestone',
            'userProgress',
            'isAchieved',
            'relatedArticles',
            'relatedRecipes',
            'relatedStimulations'
        ));
    }
}
