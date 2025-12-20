<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Article;

class EmailService
{
    protected $nodeApiUrl;

    public function __construct()
    {
        $this->nodeApiUrl = env('NODE_EMAIL_API_URL', 'http://localhost:3000');
    }

    public function sendArticleUpdateEmail($userEmail, $userName, Article $article)
    {
        try {
            $response = Http::timeout(30)->post($this->nodeApiUrl . '/kirim-email-artikel', [
                'emailTujuan' => $userEmail,
                'userName' => $userName,
                'article' => [
                    'title' => $article->title,
                    'content' => $article->content ?? '',
                    'excerpt' => $this->getArticleExcerpt($article),
                    'id' => $article->id,
                    'slug' => $article->slug ?? $article->id,
                    'created_at' => $article->created_at->format('d M Y')
                ]
            ]);

            if ($response->successful()) {
                Log::info('Email artikel berhasil dikirim ke: ' . $userEmail);
                return true;
            } else {
                Log::error('Gagal mengirim email artikel: ' . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Error EmailService: ' . $e->getMessage());
            return false;
        }
    }

    private function getArticleExcerpt(Article $article)
    {
        $content = $article->content ?? '';
        $cleanContent = strip_tags($content);
        
        if (strlen($cleanContent) <= 150) {
            return $cleanContent;
        }
        
        return substr($cleanContent, 0, 150) . '...';
    }
}