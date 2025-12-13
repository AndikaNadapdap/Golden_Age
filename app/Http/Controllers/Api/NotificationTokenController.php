<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use Illuminate\Http\Request;

class NotificationTokenController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'token' => 'required|string|max:2048',
            'platform' => 'nullable|string|max:20',
        ]);

        DeviceToken::updateOrCreate(
            ['token' => $data['token']],
            [
                'user_id' => $request->user()->id,
                'platform' => $data['platform'] ?? 'web',
                'last_seen_at' => now(),
            ]
        );

        return response()->json(['message' => 'Token saved']);
    }
}
