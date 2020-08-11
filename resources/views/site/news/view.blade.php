@extends('site.layouts.main')
@section('title', $item->title)

@section('content')
    <p>{{ $item->text }}</p>
    <p>{{ $item->created_at }}</p>
    <p>Дата публикации : {{ $item->created_at }}</p>
@endsection
