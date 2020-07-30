@extends('site.layouts.main')
@section('title', 'Title h1')
@section('description', 'Наш сервис позволяет любому защитить свои права и обратиться в суд без расходов на юриста')

@section('content')
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Free</h4>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-lg btn-block btn-outline-primary">Button</button>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Pro</h4>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-lg btn-block btn-outline-primary">Button</button>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Enterprise</h4>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-lg btn-block btn-outline-primary">Button</button>
            </div>
        </div>
    </div>
@endsection
