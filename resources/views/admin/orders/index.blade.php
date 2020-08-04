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
                <th scope="col">{{ __('admin.orders.document-id') }}</th>
                <th scope="col">{{ __('admin.orders.transaction') }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($main as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->user->email }}</td>
                    <td>{{ $item->document_file_id }}
                    <td>{{ $item->transaction }}
                    </td>
                    <td>
                        <a href="{{ route('orders.show',$item->id) }}"><i class="far fa-eye"></i></a>
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