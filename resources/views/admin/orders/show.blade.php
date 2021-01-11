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
            <td>@if(strlen($main->user->email) > 245) {{$main->user->email_pay}} @else {{ $main->user->email }} @endif</td>
        </tr>
        <tr>
            <th>{{ __('admin.orders.document') }}</th>
            <td>{{ $main->file_path }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.orders.status') }}</th>
            <td>
                @if($main->status)
                    {{ __('admin.enabled_pay') }}
                @else
                    {{ __('admin.disabled_pay') }}
                @endif
            </td>
        </tr>
        <tr>
            <th>{{ __('admin.created') }}</th>
            <td>{{ $main->created_at }}</td>
        </tr>
        <tr>
            <th>{{ __('admin.order_pay_date') }}</th>
            <td>{{ $main->updated_at }}</td>
        </tr>
    </table>
@endsection