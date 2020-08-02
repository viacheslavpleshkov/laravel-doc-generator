@extends('admin.layouts.main')

@section('title',__('admin.types.create'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('types.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>{{ __('admin.types.name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                   placeholder="{{ __('admin.types.enter-name') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.types.url') }}</label>
            <input type="text" class="form-control" name="url" value="{{ old('url') }}"
                   placeholder="{{ __('admin.types.enter-url') }}" required>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.create') }}</button>
    </form>
@endsection