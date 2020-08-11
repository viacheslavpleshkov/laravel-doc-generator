@extends('site.layouts.main')
@section('title', __('site.nav.protect'))

@section('content')
    @foreach($main as $item)
        <h2 class="text-center">{{ $item->title }}</h2>
        <p>{{ $item->text }}</p>
        <p>Дата публикации : {{ $item->created_at }}</p>
        <hr>
    @endforeach
@endsection
