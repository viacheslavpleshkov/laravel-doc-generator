@extends('site.layouts.main')

@section('title',__('admin.documents-keys.create'))

@section('content')
    <form action="{{ route('site.situation_form') }}" method="POST">
        @csrf
        @foreach($main as $item)
            <div class="form-group">
                <label>{{ $item->title }}</label>
                <input type="hidden" id="custId" value="3487">
                <input type="text" class="form-control" name="{{ $item->id }}" value="{{ old($item->id) }}"
                       placeholder="Введите {{ $item->title }}" required>
            </div>
        @endforeach
        <button class="btn btn-lg btn-block btn-outline-primary" type="submit">Создать документ</button>
    </form>
@endsection