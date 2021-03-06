@extends('admin.layouts.main')

@section('title',__('admin.types.show'))

@section('content')
    @include('admin.includes.title')
    <ul class="nav mb-md-3">
        <li>
            <a href="{{ route('types.index') }}" class="btn btn-outline-primary">{{ __('admin.back') }}</a>
            <a href="{{ route('types.edit', $main->id) }}" class="btn btn-outline-secondary">{{ __('admin.update') }}</a>
            <form action="{{ route('types.destroy', $main->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="if(!confirm('{{ __('admin.trash') }}')) return false;">{{ __('admin.delete') }}</button>
            </form>
        </li>
    </ul>
    <table class="table">
        <tr>
            <th>{{ __('admin.types.id') }}</th>
            <td>{{ $main->id }}</td>
        </tr>

        <tr>
            <th>{{ __('admin.types.name') }}</th>
            <td>{{ $main->name }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.types.url') }}</th>
            <td>{{ $main->url }}</td>
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