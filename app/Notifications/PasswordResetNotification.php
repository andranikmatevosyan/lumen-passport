<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Notification;

class PasswordResetNotification extends Notification
{
    use Queueable;

    private string $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(private string $url)
    {
        $this->subject = 'Password Reset';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  User  $notifiable
     * @return array
     */
    public function via(User $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  User  $notifiable
     * @return MailMessage
     */
    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->markdown('emails.auth.user.password-email', $this->toArray($notifiable));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  User  $notifiable
     * @return array
     */
    public function toArray(User $notifiable): array
    {
        return [
            'notifiable' => $notifiable,
            'url' => $this->url,
        ];
    }
}
