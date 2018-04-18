@extends('layouts.apphome')

@section('title', 'HOME')

@section('content')

<body class="index">
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
            <a class="left carousel-control" href="#main-slide" data-slide="prev" style="display: none; pointer: none;">
                <span><i class="fa fa-angle-left"></i></span>
            </a>
            <a class="right carousel-control" href="#main-slide" data-slide="next" style="display: none; pointer: none;">
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
</body>
@endsection