@extends('site.layouts.main')

@section('title', "Заполните поля чтобы создать документ")

@section('content')
    @guest
        @include("auth.login")
    @endguest
    <form action="{{ route('site.situation.form', $situation) }}" method="POST">
        @csrf
        @foreach($main as $item_main)
            <div class="form-group">
                <label>{{ $item_main->title }}</label>
                <input type="text"
                       class="form-control"
                       name="{{ $item_main->id }}"
                       value="@foreach($data as $item_data){{ $item_main->key == $item_data->document->key ? $item_data->user_input : '' }}@endforeach"
                       placeholder="Введите {{ mb_convert_case($item_main->title, MB_CASE_LOWER, "UTF-8") }}"
                       required>

            </div>
        @endforeach

        <button class="btn btn-lg btn-block btn-outline-primary" type="submit">Создать документ</button>
    </form>
@endsection