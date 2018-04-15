<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fame - One Page Multipurpose Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('template/asset/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Font Awesome CSS -->
    <link href="{{ asset('template/css/font-awesome.min.css') }}" rel="stylesheet">
    
    
    <!-- Animate CSS -->
    <link href="{{ asset('template/css/animate.css') }}" rel="stylesheet" >
    
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.css') }}" >
    <link rel="stylesheet" href="{{ asset('template/css/owl.theme.css') }}" >
    <link rel="stylesheet" href="{{ asset('template/css/owl.transitions.css') }}" >

    <!-- Custom CSS -->
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
    
    
    <!-- Modernizer js -->
    <script src="{{ asset('template/js/modernizr.custom.js') }}"></script>

    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="index">
    
    
    <!-- Styleswitcher
================================================== -->
        <div class="colors-switcher">
            <a id="show-panel" class="hide-panel"><i class="fa fa-tint"></i></a>        
                <ul class="colors-list">
                    <li><a title="Light Red" onClick="setActiveStyleSheet('light-red'); return false;" class="light-red"></a></li>
                    <li><a title="Blue" class="blue" onClick="setActiveStyleSheet('blue'); return false;"></a></li>
                    <li class="no-margin"><a title="Light Blue" onClick="setActiveStyleSheet('light-blue'); return false;" class="light-blue"></a></li>
                    <li><a title="Green" class="green" onClick="setActiveStyleSheet('green'); return false;"></a></li>
                    
                    <li class="no-margin"><a title="light-green" class="light-green" onClick="setActiveStyleSheet('light-green'); return false;"></a></li>
                    <li><a title="Yellow" class="yellow" onClick="setActiveStyleSheet('yellow'); return false;"></a></li>
                </ul>
        </div>  
<!-- Styleswitcher End
================================================== -->

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Alumni STEI</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>

                        <a class="page-scroll" href="#feature">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about-us">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#service">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Team</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#pricing">Pricing</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#latest-news">Latest News</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#testimonial">Testimonials</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#partner">Partner</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    
    
    
    <!-- Start Home Page Slider -->
    <section id="page-top">
        <!-- Carousel -->
        <div id="main-slide" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#main-slide" data-slide-to="0" class="active"></li>
                <li data-target="#main-slide" data-slide-to="1"></li>
                <li data-target="#main-slide" data-slide-to="2"></li>
            </ol>
            <!--/ Indicators end-->

            <!-- Carousel inner -->
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="{{ asset('template/images/banner.jpg') }}" alt="slider">
                    <div class="slider-content">
                        <div class="col-md-12 text-center">
                            <h1 class="animated3">
                                <span>About <strong>Alumni STEI</strong></span>
                            </h1>
                            <p class="animated">Sekolah Teknik Elektro dan Informatika (STEI-ITB) yang diresmikan pada 1 Januari 2006 merupakan gabungan dua departemen di ITB, yaitu Departemen Teknik Elektro dan Teknik Informatika (SK Rektor No. 012/SK/01/OT/2005)</p>	
                            <a href="#about-us" class="page-scroll btn btn-primary animated1">Read More</a>
                        </div>
                    </div>
                </div>
                <!--/ Carousel item end -->
            </div>
            <!-- Carousel inner end-->

            <!-- Controls -->
            <a class="left carousel-control" href="#main-slide" data-slide="prev">
                <span><i class="fa fa-angle-left"></i></span>
            </a>
            <a class="right carousel-control" href="#main-slide" data-slide="next">
                <span><i class="fa fa-angle-right"></i></span>
            </a>
        </div>
        <!-- /carousel -->
    </section>
    <!-- End Home Page Slider -->    

    <!-- Start About Us Section -->
    <section id="about-us" class="about-us-section-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title text-center">
                            <h1>About Us</h1>
                            <h3>Sejarah</h3>
                                <p>Sekolah Teknik Elektro dan Informatika (STEI-ITB) yang diresmikan pada 1 Januari 2006 merupakan gabungan dua departemen di ITB, yaitu Departemen Teknik Elektro dan Teknik Informatika (SK Rektor No. 012/SK/01/OT/2005). Kedua departemen ini mempunyai sejarah yang panjang dalam penyelenggaraan pendidikan tinggi Teknik Elektro (EL) sejak tahun 1974, dan Teknik Informatika (IF) sejak tahun 1982.</p>
                                <p>Seiring dengan perkembangan Kurikulum 2008 dan kebutuhan masyarakat serta industri STEI ITB membuka dan menambah tiga program studi baru. Hal ini dibuktikan dengan terbitnya SK Rektor Nomor : 268/SK/K01/OT/2008 tentang Pembukaan Program Studi Sarjana Teknik Tenaga Listrik, Teknik Telekomunikasi, Sistem dan Teknologi Informasi tanggal 26 nopember 2008. Pada tahun 2016, Program Studi Teknik Biomedika resmi beroperasi. Oleh karena itu saat ini STEI menyelenggarakan pendidikan sejumlah 6 (enam) Program Sarjana Teknik (S1), yaitu Sarjana Teknik Elektro, Sarjana Teknik Informatika, Sarjana Teknik Tenaga Listrik, Sarjana Teknik Telekomunikasi, Sarjana Sistem dan Teknologi Informasi, dan Sarjana Teknik Biomedika yang masing – masing berlangsung 8 semester dengan total kredit 144 SKS. Selain itu STEI ITB juga menyelenggarakan Program Magister Teknik (S2) dan Program Doktor (S3).</p>
                                <h3>Visi</h3>
                                <p>Menjadi Institusi pendidikan tinggi, pengembang ilmu pengetahuan Teknik Elektro dan Informatika yang unggul dan terkemuka di Indonesia dan diakui di dunia serta berperan aktif dalam usaha memajukan dan mensejahterakan bangsa.</p>
                                <h3>Misi</h3>
                                <ol>
                                <p>Menyelenggarakan pendidikan tinggi dan pendidikan berkelanjutan di bidang teknik Elektro dan Informatika dengan memanfaatkan teknologi komunikasi dan informasi .</p>
                                <p>Mengikuti (memelihara) keterkinian (<em>state of the art</em>) serta mengembangkan ilmu pengetahuan Teknik Elektro dan Informatika melalui kegiatan penelitian yang inovatif.</p>
                                <p>Mendiseminasikan ilmu pengetahuan, teknologi dan pandangan/wawasan Teknik Elektro dan Informatika yang dimiliki kepada masyarakat baik melalui lulusannya, kemitraan dengan industri atau lembaga lainnya maupun melalui kegiatan pengabdian pada masyarakat dalam rangka membentuk masyarakat berkearifan teknologi.</p>

                        </div>
                </div>
            </div>
            
        </div><!-- /.container -->
    </section>
   <!-- End About Us Section -->


    <div id="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>

    

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
    <script src="{{ asset('template/js/contact_me.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('template/js/script.js') }}"></script>

</body>

</html>
