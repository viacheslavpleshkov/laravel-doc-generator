@extends('admin.layouts.main')

@section('title',__('admin.documents-keys.edit'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('documents-keys.update', ['id' => $main->id, 'document' => $document]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="disabledTextInput">{{ __('admin.documents-keys.name') }}</label>
            <input type="text" id="disabledTextInput" class="form-control" name="title" value="{{ $main->title }}"
                   placeholder="{{ __('admin.documents-keys-enter-name') }}">
        </div>

        <div class="form-group">
            <label>{{ __('admin.documents-keys.key') }}</label>
            <input type="text" class="form-control" name="key" value="{{ $main->key }}"
                   placeholder="{{ __('admin.documents-keys-enter-key') }}" required>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.edit') }}</button>
    </form>
@endsection