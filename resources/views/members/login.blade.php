<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="{{ asset('packages/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <title>@yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
</head>
@include('inc.messages')
<body class="bodyLogin" style="background:url({{url('storage/banner_darken.png')}}) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;">
<div class="container justify-content-center header-login">
            <div class="loginTitle text-center">
                <img src="{{URL::asset('storage/logo_itb.png')}}" style="margin: 0 auto; float:none; margin-right: 1%;" id=loginItb>
                <i class="title1">Web Alumni</i>
                <i class="title2">STEI-ITB</i>
            </div>
</div>
<div class="container-fluid loginContainer-member">
    <div class="justify-content-center">
            <div class="text-center header-login-member-padding">
                <h2 class="text-center text-uppercase text-white"><b>Login</b></h2>
                <hr width=30%>
            </div>
            <section class="portfolio" id="portfolio">
                <div class="row justify-content-center">
                    <div class="login-button-margin-right">
                    <a class="portfolio-item d-block mx-auto" href="/login/google">
                        <div class="portfolio-item-caption-google d-flex position-absolute h-100 w-100">
                        <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                            <i>Google</i>
                        </div>
                        </div>
                        <img class="img-fluid" src="{{URL::asset('storage/login_google.png')}}" alt="">
                    </a>
                    </div>
                    <div>
                    <a class="portfolio-item d-block mx-auto" href="/login/facebook">
                        <div class="portfolio-item-caption-facebook d-flex position-absolute h-100 w-100">
                        <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                            <i>Facebook</i>
                        </div>
                        </div>
                        <img class="img-fluid" src="{{URL::asset('storage/login_facebook.png')}}" alt="">
                    </a>
                    </div>
                    <div class="login-button-margin-left">
                    <a class="portfolio-item d-block mx-auto" href="/login/linkedin">
                        <div class="portfolio-item-caption-linkedin d-flex position-absolute h-100 w-100">
                        <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                            <i>Linkedin</i>
                        </div>
                        </div>
                        <img class="img-fluid" src="{{URL::asset('storage/login_linkedin.png')}}" alt="">
                    </a>
                    </div>
                </div>
            </section>
    </div>
</div>
</body>
</html>

@section('title', 'Login Admin')