<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index(Request $request)
    {
        return Reminder::where('user_id', $request->user()->id)
            ->orderByDesc('scheduled_at')
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'child_id' => 'nullable|integer',
            'milestone_id' => 'nullable|integer',
            'title' => 'required|string|max:150',
            'body' => 'nullable|string',
            'scheduled_at' => 'required|date',
        ]);

        $reminder = Reminder::create([
            'user_id' => $request->user()->id,
            'child_id' => $data['child_id'] ?? null,
            'milestone_id' => $data['milestone_id'] ?? null,
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'scheduled_at' => $data['scheduled_at'],
            'status' => 'pending',
        ]);

        return response()->json($reminder, 201);
    }
}
