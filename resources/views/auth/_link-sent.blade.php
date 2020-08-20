@extends('site.layouts.main')

@section('title', "Успех")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="alert text-center text-muted text-center">
                            Проверьте свою электронную почту, чтобы найти ссылку для входа, которая будет действительна только в течение следующих 15 минут.
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    Получить другую ссылку
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
