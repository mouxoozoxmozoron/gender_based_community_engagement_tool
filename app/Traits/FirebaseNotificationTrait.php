<?php

namespace App\Traits;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

trait FirebaseNotificationTrait
{
    /**
     * Send Firebase Push Notification
     *
     * @param string $title - Notification title
     * @param string $body - Notification body
     * @param string $token - FCM Token of the device
     */
    public function sendFirebaseNotification($title, $body, $token)
    {
        // Create a Firebase messaging instance using the service account file
        $firebase = (new Factory)->withServiceAccount(env('FIREBASE_CREDENTIALS_PATH'));

        // Create a messaging instance
        $messaging = $firebase->createMessaging();

        // Build the message with target token, title, and body
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create($title, $body));

        // Send the notification
        $messaging->send($message);
    }
}
