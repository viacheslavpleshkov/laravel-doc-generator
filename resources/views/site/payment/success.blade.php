@extends('site.layouts.main')
@section('title', 'Оплата прошла успешно: '.$order->user->email_pay)

@section('content')
    <div class="container">
        <p>Если Вы не получили сгенерированный документ на указанную электронную почту, проверьте папку Spam, либо скачайте документ по указанной ниже ссылке. Если у  Вас остались вопросы, напишите нам в службу поддержки   по адресу support@vsudbezurista.ru или в Telegram.</p>
        <table class="table table-bordered">
            <div class="row">
                <tr>
                    <th>{{ __('site.order.id') }}</th>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('site.order.user_name') }}</th>
                    <td>{{ $order->user->email_pay }}</td>
                </tr>
                <tr>
                    <th>{{ __('site.order.status') }}</th>
                    <td>оплачено</td>
                </tr>
                <tr>
                    <th>{{ __('site.order.create_at') }}</th>
                    <td>{{ $order->updated_at }}</td>
                </tr>
            </div>
        </table>
        <a class="btn btn-lg btn-outline-primary text-center d-flex justify-content-center"
           href="{{ asset($order->file_path) }}">Скачать документ</a>
    </div>
@endsection
