<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class absentStudentNotification extends Notification
{
    use Queueable;

    public $student;
    /**
     * Create a new notification instance.
     */
    public function __construct($student)
    {
        $this->student = $student; // تمرير كائن الطالب إلى الباني
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    /**
     * Get the fcm representation of the notification.
     */
    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setNotification(FcmNotification::create(
                'غياب طالب', // عنوان الإشعار
                'معلومة : ' . $this->student->name . ' غائب اليوم.' // نص الإشعار
            ))       ->custom([
                'android' => [
                    'notification' => [
                        'color' => '#0A0A0A',
                        'sound' => 'default',
                    ],
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
                'apns' => [
                    'payload' => [
                        'aps' => [
                            'sound' => 'default'
                        ],
                    ],
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
            ]);
    }

}
