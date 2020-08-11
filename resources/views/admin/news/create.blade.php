@extends('admin.layouts.main')

@section('title',__('admin.documents-keys.create'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('documents-keys.store', $document) }}" method="POST">
        @csrf

        <div class="form-group">
            <label>{{ __('admin.documents-keys.name') }}</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                   placeholder="{{ __('admin.documents-keys.enter-name') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.documents-keys.key') }}</label>
            <input type="text" class="form-control" name="key" value="{{ old('key') }}"
                   placeholder="{{ __('admin.documents-keys.enter-key') }}" required>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.create') }}</button>
    </form>
@endsection