@extends('admin.layouts.main')

@section('title',__('admin.documents-keys.title', ['name' => $name]))

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
                <a class="btn btn-outline-success"
                   href="{{ route('documents-keys.create', $document) }}">{{ __('admin.documents-keys.create') }}</a>
            </div>
        </div>
    </div>
    @include('admin.includes.success')
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">{{ __('admin.documents-keys.id') }}</th>
                <th scope="col">{{ __('admin.documents-keys.name') }}</th>
                <th scope="col">{{ __('admin.documents-keys.key') }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($main as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->key }}</td>
                    <td>
                        <a href="{{ route('documents-keys.show', ['id' => $item->id, 'document' => $document]) }}"
                           class="btn btn-outline-primary">{{ __('admin.show') }}</a>
                        <a href="{{ route('documents-keys.show', ['id' => $item->id, 'document' => $document]) }}"
                           class="btn btn-outline-secondary">{{ __('admin.edit') }}</a>
                        <form action="{{ route('documents-keys.destroy', ['id' => $item->id, 'document' => $document]) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="if(!confirm('{{ __('admin.trash') }}')) return false;">
                                <i class="btn btn-outline-danger">{{ __('admin.delete') }}</i>
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