@extends('site.layouts.main')
@section('title', $main->name)

@section('content')
    <div class="card-deck mb-3 text-center">
        @foreach($situation as $item)
            <div class="card mb-4 shadow-sm">
                <div class="card-header head-card-bs">
                    <h4 class="my-0 font-weight-normal text-card-bs">{{ $item->name }}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">{{ $item->price }}</h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>{{ $item->description }}</li>
                    </ul>
                    <a href="{{ route('site.situation.index', $item->id) }}"
                       class="btn btn-lg btn-block btn-outline-secondary">Сделать документ</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
