@extends('admin.layouts.main')

@section('title',__('admin.news.show'))

@section('content')
    @include('admin.includes.title')
    <ul class="nav mb-md-3">
        <li>
            <a href="{{ route('news.index') }}" class="btn btn-outline-primary">{{ __('admin.back') }}</a>
            <a href="{{ route('news.edit', $main->id) }}" class="btn btn-outline-secondary">{{ __('admin.update') }}</a>
            <form action="{{ route('news.destroy', $main->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="if(!confirm('{{ __('admin.trash') }}')) return false;">{{ __('admin.delete') }}</button>
            </form>
        </li>
    </ul>
    <table class="table">
        <tr>
            <th>{{ __('admin.news.id') }}</th>
            <td>{{ $main->id }}</td>
        </tr>

        <tr>
            <th>{{ __('admin.news.name') }}</th>
            <td>{{ $main->title }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.news.url') }}</th>
            <td>{{ $main->text }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.news.url') }}</th>
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