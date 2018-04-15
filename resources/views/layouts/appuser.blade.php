<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <title>Freelancer - Start Bootstrap Theme</title>
    
        <!-- Bootstrap core CSS -->
        {{-- <link href="{{ asset('packages/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
        <!-- Custom fonts for this template -->
        <link href="{{ asset('packages/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    
        <!-- Plugin CSS -->
        <link href="{{ asset('packages/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        
    </head>
<body>
    @include('inc.navbaruser')
    
    @yield('content')

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('packages/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('packages/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('packages/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('packages/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
</body>
</html>