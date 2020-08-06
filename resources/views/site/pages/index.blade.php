@extends('site.layouts.main')
@section('title', '')
@section('description', 'Наш сервис позволяет любому защитить свои права и обратиться в суд без расходов на юриста')

@section('content')
    <div style="min-height: 400px;">
        <div class="card-deck mb-3 text-center">
            @foreach($main as $item)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header head-card-bs">
                        <h4 class="my-0 font-weight-normal text-card-bs">{{ $item->name }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('site.types', $item->url) }}"
                           class="btn btn-lg btn-block btn-outline-secondary">Перейти по ссылке</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
