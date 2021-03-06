@extends('site.layouts.main')
@section('title', '')
@section('description', 'Наш сервис позволяет любому защитить свои права и обратиться в суд без расходов на юриста')

@section('content')
    <h3 class="text-center col-lg-12">Выберите кто вы</h3>
    <hr>
    <div class="index-card">
        <div class="card-deck mb-3 text-center">
            @foreach($main as $item)
                <div class="card col-lg-4 mb-4 card-clear">
                    <div class="card-header head-card-bs bg-white">
                        <a href="{{ route('site.types', $item->url) }}"
                           class="btn btn-lg btn-block btn-outline-primary font-weight-normal shadow-sm text-card-bs btn-center">{{ $item->name }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <h3 class="text-center col-lg-12">Узнайте, как защитить свои права без юриста </h3>
    <hr>
    <div class="index-card">
        <div class="card-deck mb-3 text-center">
            @foreach($news as $item)
                <a class="card col-lg-2 text-dark card-clear" href="{{ route('site.news.view', $item->url) }}" style="margin-bottom: 24px">
                    <div class="card-header head-card-bs bg-white" style="min-height: 130px">
                        <h4 class="btn btn-lg btn-block btn-outline-primary font-weight-normal shadow-sm text-card-bs btn-center">{{ $item->title }}</h4>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
