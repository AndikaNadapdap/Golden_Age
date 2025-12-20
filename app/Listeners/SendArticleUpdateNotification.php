<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use App\Jobs\SendArticleUpdateEmail;
use App\Models\User;

class SendArticleUpdateNotification
{
    public function handle(ArticleUpdated $event)
    {
        // Ambil semua user dengan role parent yang aktif
        $parents = User::where('role', 'parent')
                      ->whereNotNull('email')
                      ->get();

        // Dispatch job untuk setiap parent
        foreach ($parents as $parent) {
            SendArticleUpdateEmail::dispatch($parent, $event->article);
        }
    }
}