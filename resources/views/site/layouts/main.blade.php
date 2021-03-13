<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Наш сервис позволяет любому защитить свои права и обратиться в суд без расходов на юриста">
    <title>@if(url()->current() != route('site.index'))@yield('title') | {{__('site.name') }} @else{{__('site.name') }}@endif</title>

    <script src="{{ asset('js/site.js') }}" defer></script>
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">


    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body data-gr-c-s-loaded="true">

    @include('site.includes.nav')

    <div class="row">
        <div class="container">
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <h1 class="display-6">@yield('title')</h1>
                <p class="lead">@yield('description')</p>
            </div>
            @yield('content')
            @include('site.includes.footer')
        </div>
    </div>
</body>

</html>