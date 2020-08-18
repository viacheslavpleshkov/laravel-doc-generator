@extends('admin.layouts.main')

@section('title',__('admin.orders.show'))

@section('content')
    @include('admin.includes.title')
    <ul class="nav mb-md-3">
        <li>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">{{ __('admin.back') }}</a>
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
            <th>{{ __('admin.orders.document') }}</th>
            <td>{{ $main->file_path }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.orders.status') }}</th>
            <td>
                @if($main->status)
                    {{ __('admin.enabled') }}
                @else
                    {{ __('admin.disabled') }}
                @endif
            </td>
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