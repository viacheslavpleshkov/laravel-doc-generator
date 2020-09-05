@extends('site.layouts.main')
@section('title', $item->title)

@section('content')
    <p>{!! $item->text !!}</p>
    <p>Дата публикации : {{ date('d/m/Y H:i', strtotime($item->created_at)) }}</p>
@endsection
