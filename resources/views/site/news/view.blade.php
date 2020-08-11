@extends('site.layouts.main')
@section('title', $item->title)

@section('content')
    <p>{{ $item->text }}</p>
    <p>{{ $item->created_at }}</p>
@endsection
