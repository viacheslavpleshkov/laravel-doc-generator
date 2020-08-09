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
    <a href="{{ $url }}"><img src="{{ asset('img/robokassa.png') }}" class="img-center"></a>
@endsection
