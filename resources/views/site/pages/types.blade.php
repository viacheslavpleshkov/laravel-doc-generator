@extends('site.layouts.main')
@section('title', $main->name)

@section('content')
    <div class="card-deck mb-3 text-center">
        @foreach($situation as $item)
            <a href="{{ route('site.situation.index', $item->id) }}" class="card mb-4 shadow-sm">
                <div class="card-header head-card-bs">
                    <h4 class="my-0 font-weight-normal text-card-bs text-dark">{{ $item->name }}</h4>
                </div>
            </a>
        @endforeach
    </div>
@endsection
