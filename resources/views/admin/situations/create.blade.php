@extends('admin.layouts.main')

@section('title',__('admin.situations.create'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('situations.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>{{ __('admin.situations.name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                   placeholder="{{ __('admin.situations.enter-name') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.situations.description') }}</label>
            <input type="text" class="form-control" name="description" value="{{ old('description') }}"
                   placeholder="{{ __('admin.situations.enter-description') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.situations.price') }}</label>
            <input type="text" class="form-control" name="price" value="{{ old('price') }}"
                   placeholder="{{ __('admin.situations.enter-price') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.situations.type-name') }}</label>
            <select class="form-control" name="type_id" required>
                @foreach($types as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('admin.situations.documentfile-file') }}</label>
            <select class="form-control" name="document_file_id" required>
                @foreach($documentsfile as $item)
                    <option value="{{ $item->id }}">{{ $item->file_path }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.create') }}</button>
    </form>
@endsection