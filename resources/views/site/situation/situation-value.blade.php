@extends('site.layouts.main')

@section('title', "Заполните поля чтобы создать документ")

@section('content')
    <form action="{{ route('site.situation.update_form', $situation) }}" method="POST">
        @csrf
        @foreach($main as $item)
            <div class="form-group">
                <label>{{ $item->document->title }}</label>

                <input type="text" class="form-control" name="{{ $item->document->id  }}" value="{{ $item->user_input }}"
                       placeholder="Введите {{ strtolower($item->document->title) }}" required>
            </div>
        @endforeach
        <button class="btn btn-lg btn-block btn-outline-primary" type="submit">Создать документ</button>
    </form>
@endsection