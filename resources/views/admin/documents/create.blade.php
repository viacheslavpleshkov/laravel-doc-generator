@extends('admin.layouts.main')

@section('title',__('admin.documents.create'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('documents.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>{{ __('admin.documents.name') }}</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                   placeholder="{{ __('admin.documents.enter-name') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.documents.key') }}</label>
            <input type="text" class="form-control" name="key" value="{{ old('key') }}"
                   placeholder="{{ __('admin.documents.enter-key') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.documents.document_file') }}</label>
            <select class="form-control" name="document_file_id" required>
                @foreach($main as $item)
                    <option value="{{ $item->id }}">({{ $item->id }}) {{ $item->file_path }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.create') }}</button>
    </form>
@endsection