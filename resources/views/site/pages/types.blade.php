@extends('site.layouts.main')
@section('title', $main->name)

@section('content')
    <div class="row">
        @foreach($situation as $item)
            <div class="dropdown col-4">
                <a class="btn btn-outline-primary dropdown-toggle mb-3 center-div" href="#" role="button" id="dropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $item->name }}
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('site.situation.index', ['url' =>$main->url, 'id' => $item->id]) }}">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
