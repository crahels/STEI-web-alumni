<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container">
            @if (count($array_members) > 0)
                @foreach($array_members as $member)
                    {{$member->name}} {{$member->email}} {{$member->phone_number}} {{$member->id}} 
                    <br>
                @endforeach
            @else
                no member added
            @endif
        </div>
    </body>
</html>