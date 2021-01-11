@extends('admin.layouts.main')

@section('title',__('admin.orders.title'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.success')
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">{{ __('admin.orders.id') }}</th>
                <th scope="col">{{ __('admin.orders.user-name') }}</th>
                <th scope="col">{{ __('admin.orders.document') }}</th>
                <th scope="col">Ситуация</th>
                <th scope="col">{{ __('admin.orders.status') }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($main as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->user->email_pay }}</td>
                    <td><a href="{{ asset($item->file_path) }}" target="_blank"
                           class="btn btn-outline-success">Скачать</a>
                    <td>
                        {{ $item->situation->name }}
                    </td>
                    <td>
                        @if($item->status)
                            Оплачено
                        @else
                            Не оплачено
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('orders.show',$item->id) }}"
                           class="btn btn-outline-primary">{{ __('admin.show') }}</a>
                    </td>
                </tr>
            @endforeach
            @if(isset($main) && count($main) === 0)
                <td colspan="100%" class="text-center">{{ __('admin.no-data-table') }}</td>
            @endif
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            {{ $main->links() }}
        </div>
    </div>
@endsection