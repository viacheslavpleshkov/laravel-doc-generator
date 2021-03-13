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
class DeleteFile extends Notification
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
      ->subject('Мы через 3 дня удалим ваши данные из нашей истории.')
      ->line("Пожалуйста, сообщите, если Вы хотели бы снова воспользоваться нашим сервисом согласны с тем, чтобы мы хранили Ваши данные")
      ->action('Далее', asset($this->link))
      ->line('Если впоследствие Вы захотите, чтобы мы удалили Ваши данные – сообщите нам об этом на адрес: contact@vsudbezurista.ru');
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
