<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAISafeController extends Controller
{
    public function showForm()
    {
        return view('openai.safe');
    }

    public function chat(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:10000',
        ]);

        $prompt = $request->input('prompt');

        if (env('OPENAI_MOCK', true) || !env('ENABLE_OPENAI_ROUTES', false)) {
            // Local mock response for safe dev without quota
            $reply = "(mock) Echo: " . $prompt;
            return back()->with('openai_response', $reply)->withInput();
        }

        $apiKey = env('OPENAI_API_KEY');
        if (empty($apiKey)) {
            return back()->withErrors(['openai' => 'OpenAI API key not configured']);
        }

        try {
            $model = env('OPENAI_MODEL', 'gpt-4o');
            $maxTokens = (int) env('OPENAI_MAX_TOKENS', 1500);

            $response = Http::withToken($apiKey)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'max_tokens' => $maxTokens,
                    'temperature' => floatval(env('OPENAI_TEMPERATURE', 0.7)),
                ]);

            if ($response->failed()) {
                Log::warning('OpenAI request failed', ['status' => $response->status(), 'body' => $response->body()]);
                return back()->withErrors(['openai' => 'OpenAI request failed'])->withInput();
            }

            $body = $response->json();
            $content = data_get($body, 'choices.0.message.content', '(no reply)');

            return back()->with('openai_response', $content)->withInput();

        } catch (\Exception $e) {
            Log::error('OpenAI exception', ['error' => $e->getMessage()]);
            return back()->withErrors(['openai' => 'OpenAI request error'])->withInput();
        }
    }
}
