@extends('admin.layouts.main')

@section('title',__('admin.news.create'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('news.store', $document) }}" method="POST">
        @csrf

        <div class="form-group">
            <label>{{ __('admin.news.title') }}</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                   placeholder="{{ __('admin.news.enter-name') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.news.url') }}</label>
            <input type="text" class="form-control" name="url" value="{{ old('url') }}"
                   placeholder="{{ __('admin.news.enter-url') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.news.text') }}</label>
            <textarea name="text" class="form-control" cols="30" placeholder="{{ __('admin.news.enter-text') }}"
                      rows="10"></textarea>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.create') }}</button>
    </form>
@endsection