@extends('admin.layouts.main')

@section('title',__('admin.situations.edit'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('situations.update', $main->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>{{ __('admin.situations.name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ $main->name }}"
                   placeholder="{{ __('admin.situations.enter-name') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.situations.description') }}</label>
            <input type="text" class="form-control" name="description" value="{{ $main->description }}"
                   placeholder="{{ __('admin.situations.enter-description') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.situations.price') }}</label>
            <input type="text" class="form-control" name="price" value="{{ $main->price }}"
                   placeholder="{{ __('admin.situations.enter-price') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.users.type-name') }}</label>
            <select class="form-control" name="type_id" required>
                <option value="{{ $main->type->id }}">{{ $main->type->name }}</option>
                @foreach($types as $item)
                    @if($main->type->id === $item->id) @continue; @endif
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('admin.situations.documentfile-file') }}</label>
            <select class="form-control" name="document_file_id" required>
                <option value="{{ $main->documentfile->id }}">{{ $main->documentfile->file_path }}</option>
                @foreach($documentsfile as $item)
                    @if($main->documentfile->id === $item->id) @continue; @endif
                    <option value="{{ $item->id }}">{{ $item->file_path }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.edit') }}</button>
    </form>
@endsection