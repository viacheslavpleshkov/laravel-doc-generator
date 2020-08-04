@extends('admin.layouts.main')

@section('title',__('admin.documents-files.create'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('documents-files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.create') }}</button>
    </form>
@endsection