@extends('admin.layouts.main')

@section('title',__('admin.news.edit'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('news.update',$main->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>{{ __('admin.news.name') }}</label>
            <input type="text" class="form-control" name="title" value="{{ $main->title }}"
                   placeholder="{{ __('admin.news.enter-name') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.news.text') }}</label>
            <textarea name="text" class="form-control" cols="30" placeholder="{{ __('admin.news.enter-text') }}" rows="10">{{ $main->text }}</textarea>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.edit') }}</button>
    </form>
@endsection