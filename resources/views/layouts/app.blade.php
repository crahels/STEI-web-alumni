<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container">
            @include('inc.messages')
            @include('inc.navbar')
            @yield('content')
        </div>
    </body>
</html>
