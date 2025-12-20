<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendArticleUpdateEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $article;

    public function __construct(User $user, Article $article)
    {
        $this->user = $user;
        $this->article = $article;
    }

    public function handle(EmailService $emailService)
    {
        $emailService->sendArticleUpdateEmail(
            $this->user->email,
            $this->user->name,
            $this->article
        );
    }
}