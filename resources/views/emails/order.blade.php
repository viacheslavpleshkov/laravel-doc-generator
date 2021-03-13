@component('mail::message')
    Здравствуйте, **{{$order->user->email_pay}}**!<br>
    Номер заказа: {{ $order->id }} <br>
    Цена: {{ $order->price }} <br>
    Статус документа: оплачено <br>
    @component('mail::button', ['url' => asset($order->file_path)])
        Скачать документ
    @endcomponent
    Инструкция по использованию документа прилагается к созданному документу. <br>
    Мы сохраняем созданный Вами документ в системе в течение 90 дней, чтобы при создании нового документа Вы могли использовать введенные Вами данные. <br>
    Если Вы не хотите, чтобы мы сохраняли документ в нашей системе - пройдите по ссылке.<br>
    @component('mail::button', ['url' => route('site.user-delete-information', $order->user_id)])
        Удалить данные
    @endcomponent
    
    Спасибо, что используете всудбезюриста.рф.
@endcomponent