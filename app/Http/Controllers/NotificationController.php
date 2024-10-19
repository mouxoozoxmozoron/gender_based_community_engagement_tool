<?php

namespace App\Http\Controllers;

use App\Traits\FirebaseNotificationTrait;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
     // Use the trait
     use FirebaseNotificationTrait;

     public function sendNotificationToUser()
     {
         // Example data
         $title = "New Post Alert";
         $body = "Check out the latest post on our platform!";
         $fcmToken = "user-device-fcm-token"; // The FCM token of the target user/device

         // Use the trait method to send the notification
         $this->sendFirebaseNotification($title, $body, $fcmToken);

         return response()->json(['message' => 'Notification sent!']);
     }
}
