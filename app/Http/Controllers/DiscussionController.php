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
        $query = Discussion::with('author')
                    ->withCount('replies')
                    ->whereHas('author'); // Only get discussions with valid user

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
        // Allow parent and doctor to create discussions
        if (auth()->user()->role === 'admin') {
            return redirect()->route('discussions.index')
                           ->with('error', 'Admin tidak dapat membuat diskusi.');
        }

        $categories = ['Kehamilan', 'MPASI', 'Kesehatan', 'Perkembangan', 'Lainnya'];
        return view('discussions.create', compact('categories'));
    }

    // Simpan diskusi baru
    public function store(Request $request)
    {
        // Block admin from creating discussions
        if (auth()->user()->role === 'admin') {
            return redirect()->route('discussions.index')
                           ->with('error', 'Admin tidak dapat membuat diskusi.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
        ]);

        Discussion::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'category' => $request->category,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('discussions.index')->with('success', 'Diskusi berhasil dibuat!');
    }

    // Like/Unlike diskusi
    public function like($id)
    {
        $discussion = Discussion::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        // Toggle like: jika sudah like, maka unlike
        if ($discussion->isLikedBy($user)) {
            $discussion->likedByUsers()->detach($user->id);
            $isLiked = false;
            $message = 'Like dibatalkan';
        } else {
            $discussion->likedByUsers()->attach($user->id);
            $isLiked = true;
            $message = 'Diskusi disukai';
        }

        return response()->json([
            'success' => true,
            'likes' => $discussion->likedByUsers()->count(),
            'isLiked' => $isLiked,
            'message' => $message
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

    // Like/Unlike reply
    public function likeReply($id)
    {
        $reply = DiscussionReply::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        // Toggle like: jika sudah like, maka unlike
        if ($reply->isLikedBy($user)) {
            $reply->likedByUsers()->detach($user->id);
            $isLiked = false;
            $message = 'Like dibatalkan';
        } else {
            $reply->likedByUsers()->attach($user->id);
            $isLiked = true;
            $message = 'Reply disukai';
        }

        return response()->json([
            'success' => true,
            'likes' => $reply->likedByUsers()->count(),
            'isLiked' => $isLiked,
            'message' => $message
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

    // Hapus diskusi (pemilik atau admin)
    public function destroy($id)
    {
        $discussion = Discussion::findOrFail($id);
        
        // Only owner or admin can delete
        if (auth()->id() != $discussion->user_id && auth()->user()->role !== 'admin') {
            return back()->with('error', 'Anda tidak memiliki akses!');
        }

        $discussion->delete();
        
        return redirect()->route('discussions.index')->with('success', 'Diskusi berhasil dihapus!');
    }

    // Hapus balasan (hanya pemilik balasan)
    public function destroyReply($id)
    {
        $reply = DiscussionReply::findOrFail($id);
        
        // Only reply owner can delete their own reply
        if (auth()->id() != $reply->user_id) {
            return back()->with('error', 'Anda tidak memiliki akses!');
        }

        $discussionId = $reply->discussion_id;
        $reply->delete();

        // Decrement replies count
        $discussion = Discussion::find($discussionId);
        if ($discussion && $discussion->replies_count > 0) {
            $discussion->decrement('replies_count');
        }
        
        return back()->with('success', 'Balasan berhasil dihapus!');
    }
}
