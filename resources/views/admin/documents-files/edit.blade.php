@extends('admin.layouts.main')

@section('title',__('admin.documents-files.edit'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('documents-files.update', $main->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>{{ __('admin.documents-files.name') }}</label>
            <input type="text" class="form-control" name="title" value="{{ $main->title }}"
                   placeholder="{{ __('admin.documents-files.enter-name') }}" required>
        </div>
        <div class="form-group">
            <label>{{ __('admin.documents-files.price') }}</label>
            <input type="number" class="form-control" name="price" value="{{ $main->price }}"
                   placeholder="{{ __('admin.documents-files.enter-price') }}" required>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.edit') }}</button>
    </form>
@endsection