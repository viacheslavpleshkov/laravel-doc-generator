@extends('admin.layouts.main')

@section('title',__('admin.documents.show'))

@section('content')
    @include('admin.includes.title')
    <ul class="nav mb-md-3">
        <li>
            <a href="{{ route('documents.index', $document) }}" class="btn btn-dark">{{ __('admin.back') }}</a>
            <a href="{{ route('documents.edit', ['id' => $main->id, 'document' => $document]) }}" class="btn btn-primary">{{ __('admin.update') }}</a>
            <form action="{{ route('documents.destroy', ['id' => $main->id, 'document' => $document]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="if(!confirm('{{ __('admin.trash') }}')) return false;">{{ __('admin.delete') }}</button>
            </form>
        </li>
    </ul>
    <table class="table">
        <tr>
            <th>{{ __('admin.documents.id') }}</th>
            <td>{{ $main->id }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.documents.document_file') }}</th>
            <td>({{ $main->documentfile->id }}) {{ $main->documentfile->file_path }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.documents.name') }}</th>
            <td>{{ $main->title }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.documents.key') }}</th>
            <td>{{ $main->key }}</td>
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