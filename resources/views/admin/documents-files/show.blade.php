@extends('admin.layouts.main')

@section('title',__('admin.documents-files.show'))

@section('content')
    @include('admin.includes.title')
    <ul class="nav mb-md-3">
        <li>
            <a href="{{ route('documents-files.index') }}" class="btn btn-outline-primary">{{ __('admin.back') }}</a>

            <form action="{{ route('documents-files.destroy', $main->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="if(!confirm('{{ __('admin.trash') }}')) return false;">{{ __('admin.delete') }}</button>
            </form>
        </li>
    </ul>
    <table class="table">
        <tr>
            <th>{{ __('admin.documents-files.id') }}</th>
            <td>{{ $main->id }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.documents-files.id') }}</th>
            <td>{{ $main->title }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.documents-files.id') }}</th>
            <td>{{ $main->file_path }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.created') }}</th>
            <td>{{ $main->created_at }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.update') }}</th>
            <td>{{ $main->updated_at }}</td>
        </tr>
    </table>
@endsection