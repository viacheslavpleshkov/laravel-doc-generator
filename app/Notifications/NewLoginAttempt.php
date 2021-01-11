<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

/**
 * Class NewLoginAttempt
 * @package App\Notifications
 */
class NewLoginAttempt extends Notification
{
    use Queueable;

    /**
     * NewLoginAttempt constructor.
     * @param $attempt
     */
    public function __construct($attempt, $url)
    {
        $this->attempt = $attempt;
        $this->url = $url;
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * @param $notifiable
     * @return mixed
     */
    public function toMail($notifiable)
    {
        return with(new MailMessage)
            ->subject('Войдите в свой аккаунт')
            ->greeting("Здраствуйте, {$this->attempt->user->email}!")
            ->line('Пожалуйста, нажмите кнопку ниже, чтобы получить доступ к приложению, которое будет действовать только 15 минут.')
            ->action('Войдите в свой аккаунт', URL::temporarySignedRoute('login.token.validate', now()->addMinutes(15), ['token' =>$this->attempt->token, 'url' => $this->url]))
            ->line('Спасибо, что используете наше приложение!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
