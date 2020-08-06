@extends('site.layouts.main')
@section('title', $main->name)

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">{{ __('site.situation.name') }}</th>
            <th scope="col">{{ __('admin.situation.price') }}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($situation as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td><a class="btn btn-secondary" href="{{ route('site.situation', $item->id) }}">Сделать документ</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
