@extends('admin.layouts.main')

@section('title',__('admin.roles.show'))

@section('content')
    @include('admin.includes.title')
    <ul class="nav mb-md-3">
        <li>
            <a href="{{ route('roles.index') }}" class="btn btn-outline-primary">{{ __('admin.back') }}</a>
            <a href="{{ route('roles.edit', $main->id) }}" class="btn btn-outline-secondary">{{ __('admin.update') }}</a>
        </li>
    </ul>
    <table class="table">
        <tr>
            <th>{{ __('admin.roles.id') }}</th>
            <td>{{ $main->id }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.roles.name') }}</th>
            <td>{{ $main->name }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.roles.description') }}</th>
            <td>{{ $main->description }}</td>
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