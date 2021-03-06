@extends('admin.layouts.main')

@section('title',__('admin.documents-files.create'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('documents-files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>{{ __('admin.documents-files.name') }}</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                   placeholder="{{ __('admin.documents-files.enter-name') }}" required>
        </div>

        <label>{{ __('admin.documents-files.file-path') }}</label><br>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{ __('admin.documents-files.upload') }}</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="file_path">
                <label class="custom-file-label"></label>
            </div>
        </div>

        <div class="form-group">
            <label>{{ __('admin.documents-files.price') }}</label>
            <input type="number" class="form-control" name="price" value="{{ old('price') }}"
                   placeholder="{{ __('admin.documents-files.enter-price') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.documents-files.situation') }}</label>
            <select class="form-control" name="situation_id" required>
                @foreach($main as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.create') }}</button>
    </form>
@endsection