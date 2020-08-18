@extends('site.layouts.main')

@section('title', "Заполните поля чтобы создать документ")

@section('content')
    <div class="container">
        @guest
            <a href="{{ route('login') }}" class="text-dark text-center" target="_blank">Авторизуйтесь на сайте чтобы
                автоматически подтянулись ваши данные</a>
        @endguest
        <form action="{{ route('site.situation.form', ['type_url' => $type_url, 'situation_id' => $situation_id,'document_id' => $document_id]) }}" method="POST">
            <div class="row">
                @csrf
                @foreach($main as $item_main)
                    <div class="col-lg-6" style="padding: 10px">
                        <label>{{ $item_main->title }}</label>
                        <input type="text"
                               class="form-control"
                               name="{{ $item_main->id }}"
                               value="@foreach($data as $item_data){{ $item_main->key == $item_data->document->key ? $item_data->user_input : '' }}@endforeach"
                               required>
                    </div>
                @endforeach
                <button class="btn btn-lg btn-outline-primary text-center" type="submit" id="inner">Создать документ
                </button>
            </div>
        </form>
    </div>
@endsection