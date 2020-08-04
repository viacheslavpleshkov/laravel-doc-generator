@extends('admin.layouts.main')

@section('title',__('admin.documents.edit'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('documents.update',$main->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="disabledTextInput">{{ __('admin.documents.name') }}</label>
            <input type="text" id="disabledTextInput" class="form-control" name="title" value="{{ $main->title }}"
                   placeholder="{{ __('admin.documents-enter-name') }}">
        </div>

        <div class="form-group">
            <label>{{ __('admin.documents.key') }}</label>
            <input type="text" class="form-control" name="key" value="{{ $main->key }}"
                   placeholder="{{ __('admin.documents-enter-key') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.documents.document_file') }}</label>
            <select class="form-control" name="document_file_id" required>
                <option value="{{ $main->document_file_id }}">{{ $main->document_file_id }}</option>
                @foreach($documents as $item)
                    @if($main->document_file_id === $item->id) @continue; @endif
                    <option value="{{ $item->id }}">{{ $item->file_path }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.edit') }}</button>
    </form>
@endsection