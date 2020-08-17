@extends('site.layouts.main')
@section('title', 'Оплата прошла успешно: '.$order->user->email_pay)

@section('content')
    <p>Если вы не получили сгенерированный документ на указанную электронную почту, проверьте папку spam. Если документа нет, напишите нам по адресу ….. и укажите альтернативный адрес электронной почты - мы направим Вам созданный Вами документ</p>
    <table class="table table-bordered">
        <div class="row">
            <tr>
                <th>{{ __('site.order.id') }}</th>
                <td>{{ $order->id }}</td>
            </tr>
            <tr>
                <th>{{ __('site.order.file_path') }}</th>
                <td>{{ asset($order->file_path) }}</td>
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
@endsection
