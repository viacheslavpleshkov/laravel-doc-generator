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
                <td>{{ $document->price }} руб</td>
            </tr>
        </div>
    </table>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{ route('site.payment.submit',['type_id' => $type_id, 'situation_id' => $situations->id, 'document_id' => $document->id]) }}" method="post">
        @csrf

        <div class="form-group">
            <label>{{ __('site.payment.email') }}</label>
            <input type="email" class="form-control" name="email" value="@auth{{ auth()->user()->email_pay }}@endif" placeholder="{{ __('site.payment.enter-email') }}" required>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="checkbox">
            <label class="form-check-label" for="exampleCheck1">Я принимаю условия <a
                        href="{{ route('site.terms-of-use') }}" target="_blank">пользовательского соглашения</a></label>
        </div>
        <br>
        <button class="btn btn-lg btn-success btn-block" type="submit">Оплатить</button>
    </form>
@endsection
