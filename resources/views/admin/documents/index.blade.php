@extends('admin.layouts.main')

@section('title',__('admin.documents.title'))

@section('content')
<div class="row justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="col-lg-9">
        <div class="d-flex">
            <h1 class="h2">@yield('title')</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="pull-right">
            <a class="btn btn-original" href="{{ route('documents.create') }}">{{ __('admin.documents.create') }}</a>
        </div>
    </div>
</div>
@include('admin.includes.success')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">{{ __('admin.documents.id') }}</th>
            <th scope="col">{{ __('admin.documents.document_file') }}</th>
            <th scope="col">{{ __('admin.documents.name') }}</th>
            <th scope="col">{{ __('admin.documents.key') }}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($main as $item)
        <tr>
            <th scope="row">{{ $item->id }}</th>
            <td>{{ $item->document_file_id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->key }}</td>
            <td>
                <a href="{{ route('documents.show', $item->id) }}"><i class="far fa-eye"></i></a>
                <a href="{{ route('documents.edit', $item->id) }}"><i class="fas fa-edit"></i></a>
                <form action="{{ route('documents.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="if(!confirm('{{ __('admin.trash') }}')) return false;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
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