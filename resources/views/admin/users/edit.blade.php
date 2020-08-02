@extends('admin.layouts.main')

@section('title',__('admin.users.edit'))

@section('content')
    @include('admin.includes.title')
    @include('admin.includes.error')
    <form action="{{ route('users.update', $main->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>{{ __('admin.users.email') }}</label>
            <input type="email" class="form-control" name="email" value="{{ $main->email }}"
                   placeholder="{{ __('admin.users.enter-email') }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('admin.users.roles') }}</label>
            <select class="form-control" name="role_id" required>
                <option value="{{ $main->role->id }}">{{ $main->role->name }}</option>
                @foreach($role as $item)
                    @if($main->role->id === $item->id) @continue; @endif
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-lg btn-original btn-block" type="submit">{{ __('admin.edit') }}</button>
    </form>
@endsection