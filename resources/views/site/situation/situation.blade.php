@extends('site.layouts.main')

@section('title', "Заполните поля чтобы создать документ: ".$title)

@section('content')
    <div class="container">
        @guest
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-center collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                Если Вы ранее пользовались нашим сервисом, укажите свою электронную почту, если хотите
                                использовать ранее введенные Вами данные
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    @if(session()->has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @elseif(session()->has('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('login.attempt') }}"
                                                  aria-label="{{ __('Login') }}">
                                                @csrf

                                                <p class="text-center">
                                                    Введите адрес своей электронной почты для получения ссылки для входа в систему.
                                                </p>
                                                <input name="url" type="hidden" value="{{ request()->path() }}">

                                                <div class="form-group row">
                                                    <label for="email"
                                                           class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email"
                                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                               name="email" value="{{ old('email') }}"
                                                               placeholder="Email Address" required autofocus>

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if(session('message'))
                                                    <div class="form-group row">
                                                        <div class="col-md-6 offset-md-4">
                                                            <div class="alert alert-success">
                                                                {{ session('message') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            Получить ссылку для входа
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
        <form action="{{ route('site.situation.form', ['type_url' => $type_url, 'situation_id' => $situation_id,'document_id' => $document_id]) }}"
              method="POST">
            <div class="row">
                @csrf
                @foreach($main as $item_main)
                    <div class="col-lg-12" style="padding: 10px">
                        @if($item_main->key == "amount_debt")
                            <input type="number" class="form-control" name="{{ $item_main->id }}"
                                   placeholder="{{ $item_main->title }}" value="@php
                                foreach($data as $item_data) {
                                    if($item_main->key==$item_data->document->key) {
                                        echo $item_data->user_input;
                                        break;
                                        }
                                } @endphp" required>
                        @else
                            <textarea row="2" class="form-control" name="{{ $item_main->id }}"
                                      placeholder="{{ $item_main->title }}" required>@php
                                    foreach($data as $item_data) {
                                        if($item_main->key==$item_data->document->key) {
                                            echo $item_data->user_input;
                                            break;
                                            }
                                    } @endphp</textarea>
                        @endif
                    </div>
                @endforeach
                <button class="btn btn-lg btn-outline-primary text-center" type="submit" id="inner">Создать документ
                </button>
            </div>
        </form>
        <br>
    </div>
@endsection