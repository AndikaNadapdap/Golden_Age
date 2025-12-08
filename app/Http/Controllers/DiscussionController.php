<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
    // Tampilkan daftar diskusi
    public function index(Request $request)
    {
        $query = Discussion::with('author')->withCount('replies');

        // Filter by category
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

        // Sort pinned first, then by latest
        $discussions = $query->orderBy('is_pinned', 'desc')
                            ->latest()
                            ->paginate(15);

        $categories = ['Kehamilan', 'MPASI', 'Kesehatan', 'Perkembangan', 'Lainnya'];

        return view('discussions.index', compact('discussions', 'categories'));
    }

    // Tampilkan detail diskusi
    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)
                                ->with(['author', 'replies.author'])
                                ->firstOrFail();

        // Increment views
        $discussion->incrementViews();

        return view('discussions.show', compact('discussion'));
    }

    // Form membuat diskusi baru
    public function create()
    {
        $categories = ['Kehamilan', 'MPASI', 'Kesehatan', 'Perkembangan', 'Lainnya'];
        return view('discussions.create', compact('categories'));
    }

    // Simpan diskusi baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
        ]);

        Discussion::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category' => $request->category,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('discussions.index')->with('success', 'Diskusi berhasil dibuat!');
    }

    // Like diskusi
    public function like($id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussion->incrementLikes();

        return response()->json([
            'success' => true,
            'likes' => $discussion->likes
        ]);
    }

    // Tambah reply/balasan
    public function reply(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $discussion = Discussion::findOrFail($id);

        DiscussionReply::create([
            'discussion_id' => $discussion->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        $discussion->incrementRepliesCount();

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }

    // Like reply
    public function likeReply($id)
    {
        $reply = DiscussionReply::findOrFail($id);
        $reply->incrementLikes();

        return response()->json([
            'success' => true,
            'likes' => $reply->likes
        ]);
    }

    // Tutup diskusi (hanya pemilik atau admin)
    public function close($id)
    {
        $discussion = Discussion::findOrFail($id);
        
        if (auth()->id() != $discussion->user_id) {
            return back()->with('error', 'Anda tidak memiliki akses!');
        }

        $discussion->update(['is_closed' => true]);
        
        return back()->with('success', 'Diskusi ditutup!');
    }
}   
