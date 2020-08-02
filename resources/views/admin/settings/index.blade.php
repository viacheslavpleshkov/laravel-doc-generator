@extends('admin.layouts.main')

@section('title',__('admin.settings.title'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    @include('admin.includes.success')
    <form action="{{ route('settings.update') }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>{{ __('admin.settings.paginate-admin') }}</label>
            <input type="text" class="form-control" name="paginate_admin" value="{{ $main->paginate_admin }}" placeholder="{{ __('admin.settings-enter-paginate-admin') }}" required>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.edit') }}</button>
    </form>
@endsection