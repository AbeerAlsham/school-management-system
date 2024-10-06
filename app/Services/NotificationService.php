<?php

namespace App\Services;

use App\Models\Accounts\UserDeviceToken;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Exception\FirebaseException;

class NotificationService
{

    public function sendNotification($data)
    {
        // Path to the service account key JSON file
        $serviceAccountPath = storage_path('app/notification.json');
        // Initialize the Firebase Factory with the service account
        $factory = (new Factory)->withServiceAccount($serviceAccountPath);
        // Create the Messaging instance
        $messaging = $factory->createMessaging();
        // Prepare the notification array
        $notification = [
            'title' => $data['title'],
            'body' => $data['content'],
            'sound' => 'default', // required for sound on iOS
        ];

        // Create an array to hold all CloudMessage instances
        $messages = [];  // هذا السطر تمت إضافته
        $tokens = UserDeviceToken::getTokenUsers($data['user_role_id']);
        foreach ($tokens as $token) {
            // هذا السطر تمت إضافته لإنشاء رسالة لكل توكن
            $messages[] = CloudMessage::withTarget('token', $token)
                ->withNotification($notification)
                ->withData(['key' => 'value']);
        }
        try {
            // Send the notifications using sendAll
            $messaging->sendAll($messages);  // هذا السطر تمت إضافته
            //  return $response->successCount(); // عدد الرسائل التي تم إرسالها بنجاح
        } catch (MessagingException $e) {
            Log::error($e->getMessage());
            return 0;
        } catch (FirebaseException $e) {
            Log::error($e->getMessage());
            return 0;
        }
    }

    public function storeNotification($data)
    {
        Notification::create($data);
    }


    public function implementNotification($data)
    {
        $this->sendNotification($data);
        $this->storeNotification($data);
    }
}
