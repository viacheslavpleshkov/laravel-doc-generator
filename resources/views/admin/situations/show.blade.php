@extends('admin.layouts.main')

@section('title',__('admin.situations.show'))

@section('content')
    @include('admin.includes.title')
    <ul class="nav mb-md-3">
        <li>
            <a href="{{ route('situations.index') }}" class="btn btn-dark">{{ __('admin.back') }}</a>
            <a href="{{ route('situations.edit', $main->id) }}" class="btn btn-primary">{{ __('admin.update') }}</a>
            <form action="{{ route('situations.destroy', $main->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="if(!confirm('{{ __('admin.trash') }}')) return false;">{{ __('admin.delete') }}</button>
            </form>
        </li>
    </ul>
    <table class="table">
        <tr>
            <th>{{ __('admin.situations.id') }}</th>
            <td>{{ $main->id }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.situations.name') }}</th>
            <td>{{ $main->name }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.situations.description') }}</th>
            <td>{{ $main->description }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.situations.price') }}</th>
            <td>{{ $main->price }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.situations.type-name') }}</th>
            <td>{{ $main->type->name }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.situations.documentfile-file') }}</th>
            <td>{{ $main->documentfile->file_path }}</td>
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