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
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
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
        return with(new MailMessage)
            ->subject('Успешная оплата документа')
            ->greeting("Здравствуйте, {$this->order->user->email_pay}!")
            ->line('Номер заказа:' . $this->order->id)
            ->line('Цена:' . $this->order->price)
            ->line('Статус документа: оплачено')
            ->action('Скачать документ', asset($this->order->file_path))
            ->line('Инструкция по использованию документа прилагается к созданному документу.')
            ->line('Мы сохраняем созданный Вами документ в системе в течение 90 дней, чтобы при создании нового документа Вы могли использовать введенные Вами данные.')
            ->line('Если Вы не хотите, чтобы мы сохраняли документ в нашей системе - пройдите по ссылке.')
            ->action('Удалить данные', route('site.user-delete-information', $this->order->user_id))
            ->line('Спасибо, что используете всудбезюриста.рф');
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
