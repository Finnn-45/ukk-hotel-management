<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $id = $notifiable->getKey();
        $hash = sha1($notifiable->getEmailForVerification());
        $verificationUrl = route('verification.verify', ['id' => $id, 'hash' => $hash]);
        $appName = config('app.name', 'StayEase Hotel');
        $userName = $notifiable->name;
        $year = date('Y');

        return (new MailMessage)
            ->subject("Verifikasi Email - {$appName}")
            ->view('emails.verify-email', [
                'userName' => $userName,
                'appName' => $appName,
                'verificationUrl' => $verificationUrl,
                'year' => $year,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
