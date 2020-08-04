@extends('admin.layouts.main')

@section('title',__('admin.orders.show'))

@section('content')
    @include('admin.includes.title')
    <ul class="nav mb-md-3">
        <li>
            <a href="{{ route('orders.index') }}" class="btn btn-dark">{{ __('admin.back') }}</a>
        </li>
    </ul>
    <table class="table">
        <tr>
            <th>{{ __('admin.orders.id') }}</th>
            <td>{{ $main->id }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.orders.user-name') }}</th>
            <td>{{ $main->user->email }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.orders.document-id') }}</th>
            <td>{{ $main->document_file_id }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.orders.transaction') }}</th>
            <td>{{ $main->transaction }}</td>
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