@extends('site.layouts.main')
@section('title', 'Оплатить за документ: '.$situations->name)

@section('content')
    <table class="table table-bordered">
        <div class="row">
            <tr>
                <th>{{ __('site.situation.name') }}</th>
                <td>{{ $situations->name }}</td>
            </tr>
            <tr>
                <th>{{ __('site.situation.description') }}</th>
                <td>{{ $situations->description }}</td>
            </tr>
            <tr>
                <th>{{ __('site.situation.price') }}</th>
                <td>{{ $situations->price }}</td>
            </tr>
        </div>
    </table>
    <h2 class="text-center">Пользовательские данные</h2>
    <table class="table table-bordered">
        @foreach($main as $item)
            <tr>
                <th>{{ $item->document->title }}</th>
                <td>{{ $item->user_input }}</td>
            </tr>
        @endforeach
    </table>

    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="same-address">
        <label class="custom-control-label" for="same-address">Я принимаю условия <a href="{{ route('site.terms-of-use') }}" target="_blank">пользовательского соглашения</a></label>
    </div>


    <a href="https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=VSUDBEZURISTA&InvId=0&Culture=ru&Encoding=utf-8&Description=helo&OutSum=100&SignatureValue=548da6a92cc34da1202514536bb0cd5a}"><img src="{{ asset('img/robokassa.png') }}" class="img-center"></a>
@endsection
