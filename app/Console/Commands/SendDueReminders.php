<?php

namespace App\Console\Commands;

use App\Models\DeviceToken;
use App\Models\Reminder;
use App\Services\FirebaseNotificationService;
use Illuminate\Console\Command;

class SendDueReminders extends Command
{
    protected $signature = 'reminders:send-due';
    protected $description = 'Send due reminders via FCM';

    public function handle(FirebaseNotificationService $fcm)
    {
        $due = Reminder::where('status', 'pending')
            ->whereNull('sent_at')
            ->where('scheduled_at', '<=', now())
            ->get();

        foreach ($due as $reminder) {
            $tokens = DeviceToken::where('user_id', $reminder->user_id)->pluck('token');

            try {
                foreach ($tokens as $token) {
                    $fcm->sendToToken(
                        $token,
                        $reminder->title,
                        $reminder->body ?? '',
                        ['reminder_id' => (string)$reminder->id]
                    );
                }
                

                $reminder->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                    'error_message' => null,
                ]);
            } catch (\Throwable $e) {
                $reminder->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ]);
            }
            if ($tokens->isEmpty()) {
    $reminder->update([
        'status' => 'failed',
        'error_message' => 'No device token for this user',
    ]);
    continue;
}
        }

        $this->info('Done. Sent: ' . $due->count());
        return 0;
    }
}
