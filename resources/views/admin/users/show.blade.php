@extends('admin.layouts.main')

@section('title',__('admin.users.show'))

@section('content')
    @include('admin.includes.title')
    <ul class="nav mb-md-3">
        <li>
            <a href="{{ route('users.index') }}" class="btn btn-outline-primary">{{ __('admin.back') }}</a>
            <a href="{{ route('users.edit', $main->id) }}" class="btn btn-outline-secondary">{{ __('admin.update') }}</a>
            <form action="{{ route('users.destroy', $main->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="if(!confirm('{{ __('admin.trash') }}')) return false;">{{ __('admin.delete') }}</button>
            </form>
        </li>
    </ul>
    <table class="table">
        <tr>
            <th>{{ __('admin.users.id') }}</th>
            <td>{{ $main->id }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.users.email') }}</th>
            <td>{{ $main->email }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.users.roles') }}</th>
            <td>{{ $main->role->name }}</td>
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
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Ключ</th>
                <th scope="col">Значение</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userFillInputRepository as $item)
                <tr>
                    <td>{{ $item->document->key }}</td>
                    <td>{{ $item->user_input }}</td>
                </tr>
            @endforeach
            @if(isset($userFillInputRepository) && count($userFillInputRepository) === 0)
                <td colspan="100%" class="text-center">{{ __('admin.no-data-table') }}</td>
            @endif
            </tbody>
        </table>
    </div>
@endsection