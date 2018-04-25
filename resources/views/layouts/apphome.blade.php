<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Web Alumni STEI</title>
    <link rel="icon" href="/storage/logo_itb.png" type="image/x-icon"/>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('template/asset/css/bootstrap.css') }}" rel="stylesheet">
    
    <!-- Font Awesome CSS -->
    <link href="{{ asset('template/css/font-awesome.min.css') }}" rel="stylesheet">
    
    
    <!-- Animate CSS -->
    <link href="{{ asset('template/css/animate.css') }}" rel="stylesheet" >
    
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.css') }}" >
    <link rel="stylesheet" href="{{ asset('template/css/owl.theme.css') }}" >
    <link rel="stylesheet" href="{{ asset('template/css/owl.transitions.css') }}" >

    <!-- Custom CSS from Template -->
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/responsive.css') }}" rel="stylesheet">
    
    <!-- Colors CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/color/green.css') }}">
    
    
    
    <!-- Colors CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/color/green.css') }}" title="green">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/color/light-red.css') }}" title="light-red">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/color/blue.css') }}" title="blue">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/color/light-blue.css') }}" title="light-blue">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/color/yellow.css') }}" title="yellow">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/color/light-green.css') }}" title="light-green">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>

    <!-- Custom CSS -->
    <link href="{{ asset('template/asset/css/bootstrap-custom.css') }}" rel="stylesheet">
    
    <!-- Modernizer js -->
    <script src="{{ asset('template/js/modernizr.custom.js') }}"></script>

    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="index">
    @include('inc.navbarhome')
    <div id="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
    @include('inc.messages')
    @yield('content')
    <footer class="style-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 footer-left-position">
                    <span class="copyright">Copyright &copy; 2018 <a href="https://themefisher.com/">ThemeFisher</a></span>
                </div>
                <div class="col-sm-offset-4 col-sm-4 col-md-offset-4 col-md-4 col-xs-12 footer-right-position">
                    <span class="copyright">Developed by <strong>STEI-ITB</strong> © 2018</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery Version 2.1.1 -->
    <script src="{{ asset('template/js/jquery-2.1.1.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('template/asset/js/bootstrap.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('template/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('template/js/classie.js') }}"></script>
    <script src="{{ asset('template/js/count-to.js') }}"></script>
    <script src="{{ asset('template/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('template/js/cbpAnimatedHeader.js') }}"></script>
    <script src="{{ asset('template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.fitvids.js') }}"></script>
    <script src="{{ asset('template/js/styleswitcher.js') }}"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{ asset('template/js/jqBootstrapValidation.js') }}"></script>
    {{-- <script src="{{ asset('template/js/contact_me.js') }}"></script> --}}

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('template/js/script.js') }}"></script>
    {{-- <script>
        function scrollDetector() {
            document.getElementById("home-navbar").classList.remove('on-page');
        }
    </script> --}}
</body>
</html>