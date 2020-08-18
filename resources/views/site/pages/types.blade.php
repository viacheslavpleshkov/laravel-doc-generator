@extends('site.layouts.main')
@section('title', $main->name)

@section('content')
    <div class="row">
        @foreach($situation as $item)
            <div class="dropdown col-4">
                <a class="btn btn-outline-primary dropdown-toggle mb-3 center-div" href="#" role="button"
                   id="dropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $item->name }}
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @foreach($documents as $document)
                        @if($document->situation_id == $item->id)
                            <a class="dropdown-item"
                               href="{{ route('site.situation.index', ['type_url' => $main->url, 'situation_id' => $item->id,'document_id' => $document->id]) }}">{{ $document->title }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
