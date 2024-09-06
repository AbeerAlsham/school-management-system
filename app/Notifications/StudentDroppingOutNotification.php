<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class StudentDroppingOutNotification extends Notification
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
                'تسرب طالب', // عنوان الإشعار
              'الأهالي الكرام نود إعلامكم أن ابنكم '.$this->student->name.'قد أصبح متسرباّ من المدرسة بسبب غيابه لمدة 14 عشر يوماّ متتاليين '// نص الإشعار
            ));
    }

}
