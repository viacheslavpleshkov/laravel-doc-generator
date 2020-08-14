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
                <td>{{ $situations->price }} рубль</td>
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

    <form action="{{ route('site.payment.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>{{ __('site.payment.email') }}</label>
            <input type="email" class="form-control" name="email" value="@auth{{  auth()->user()->email }}@endauth"
                   placeholder="{{ __('site.payment.enter-email') }}" required>
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="same-address">
            <label class="custom-control-label" for="same-address">Я принимаю условия <a
                        href="{{ route('site.terms-of-use') }}" target="_blank">пользовательского соглашения</a></label>
        </div>
        <br>
        <button class="btn btn-lg btn-success btn-block" type="submit">Оплатить</button>
    </form>
@endsection
