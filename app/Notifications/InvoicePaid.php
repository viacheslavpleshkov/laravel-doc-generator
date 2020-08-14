<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class InvoicePaid
 * @package App\Notifications
 */
class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * InvoicePaid constructor.
     * @param $user
     * @param $document
     */
    public function __construct($user, $document)
    {
        $this->user = $user;
        $this->document = $document;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Успешная оплата документа')
                    ->greeting("Привет, {$this->user->email}!")
                    ->line('Номер заказа'. $this->document->id)
                    ->line('Статус документа: оплачено')
                    ->action('Скачать документ', asset($this->document->file_path))
                    ->line('Спасибо за использование нашего приложения!');
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
