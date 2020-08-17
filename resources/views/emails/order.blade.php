@component('mail::message')
    Привет **{{$order->user->email_pay}}**!,<br>
    Номер заказа: {{ $order->id }} <br>
    Статус документа: оплачено <br>
    @component('mail::button', ['url' => asset($order->file_path)])
        Скачать документ
    @endcomponent
    Спасибо что используете наше приложение, <br>
    всудбезюриста.рф.  <br>
@endcomponent