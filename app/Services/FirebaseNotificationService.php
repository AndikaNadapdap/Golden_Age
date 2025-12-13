<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseNotificationService
{
    private $messaging;

    public function __construct()
    {
        $credentialsPath = base_path(env('FIREBASE_CREDENTIALS'));

        $factory = (new Factory)->withServiceAccount($credentialsPath);
        $this->messaging = $factory->createMessaging();
    }

    public function sendToToken(string $token, string $title, string $body, array $data = []): void
    {
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create($title, $body))
            ->withData(array_map('strval', $data));

        $this->messaging->send($message);
    }
}
