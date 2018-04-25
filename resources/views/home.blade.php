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
                @if ((Auth::user() != null) || (Auth::guard('member')->user() != null))
                    <li data-target="#main-slide" data-slide-to="3"></li>
                    <li data-target="#main-slide" data-slide-to="4"></li>
                @endif
            </ol>
            <!--/ Indicators end-->

            <!-- Carousel inner -->
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="{{ asset('template/images/banner.jpg') }}" alt="slider">
                    <div class="slider-content">
                        <div class="col-md-12 text-center">
                            <h1 class="animated3">
                            <span>Web Alumni <strong>STEI</strong></span>
                            </h1>
                            <p class="animated2">Official website of School of Electrical Engineering and Informatics<br>Bandung Institute of Technology</p>	
                            <a href="#service" class="page-scroll btn btn-primary animated1">Read More</a>
                        </div>
                    </div>
                </div>
                <!--/ Carousel item end -->
                
                @if (count($homedata[0]) > 0)
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($homedata[0] as $post)
                        @if ($i < 1)
                            <div class="item overlay">
                                <img class="img-responsive-article" src="{{ asset('template/images/article.jpg') }}" alt="slider">
                                <div class="slider-content">
                                    <div class="col-md-12 text-center">
                                        <h1 class="animated1">
                                            <span>{{$post->title}}</span>
                                        </h1>
                                        {{-- <p class="animated2">Generate a flood of new business with the<br> power of a digital media platform</p> --}}
                                        <a href="/posts/{{$post->id}}" class="page-scroll btn btn-primary animated3">Read More</a>
                                    </div>
                                </div>
                            </div>
                            @php
                                $i = $i + 1;
                            @endphp
                        @else
                            @break
                        @endif
                    @endforeach
                @endif
                
                <div class="item overlay">
                    <img class="img-responsive-article" src="{{ asset('template/images/view-more-article.jpg') }}" alt="slider">
                    <div class="slider-content">
                        <div class="col-md-12 text-center">
                            <h1 class="animated2">
                                <span>View more <strong>Article</strong></span>
                            </h1>
                            <a class="page-scroll btn btn-primary animated3" href="/article">View</a>
                        </div>
                    </div>
                </div>

                @if ((Auth::user() != null) || (Auth::guard('member')->user() != null))
                    @if (count($homedata[2]) > 0)
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($homedata[2] as $question)
                            @if ($i < 1)
                                <div class="item overlay">
                                    <img class="img-responsive-article" src="{{ asset('template/images/question.jpg') }}" alt="slider">
                                    <div class="slider-content">
                                        <div class="col-md-12 text-center">
                                            <h1 class="animated1">
                                                <span>{{$question->topic}}</span>
                                            </h1>
                                            <p class="animated2">BBB</p>
                                            <a href="/questions/{{$question->id}}" class="page-scroll btn btn-primary animated3">View question</a>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $i = $i + 1;
                                @endphp
                            @else
                                @break
                            @endif
                        @endforeach
                    @endif
                @endif

                @if ((Auth::user() != null) || (Auth::guard('member')->user() != null))
                <div class="item overlay">
                    <img class="img-responsive-article" src="{{ asset('template/images/view-more-questions.jpg') }}" alt="slider">
                    <div class="slider-content">
                        <div class="col-md-12 text-center">
                            <h1 class="animated2">
                                <span>View <strong>Forum</strong></span>
                            </h1>
                            <p class="animated2">Feel free to ask questions and give answers through our forum!</p>
                            <a class="page-scroll btn btn-primary animated3" href="/questions">Visit</a>
                        </div>
                    </div>
                </div>
                @endif
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

    <!-- Start Feature Section -->
        <section id="service" class="services-section">
            <div class="container">
                {{-- <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="section-title text-center">
                            <h3>Greetings</h3>
                            <br>
                            <p>This website is developed for alumni of STEI ITB. Through this website, you can interact with each of alumni STEI ITB that has activated their accounts.
                                If you have questions, feel free to ask our admin through our forum.
                            </p>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h3>Our Services</h3>
                            <p>These are our features that we provide just only for you.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <div class="media">
                                <div class="pull-left">
                                    <i class="fa fa-users"></i>
                                    <div class="border"></div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Meet new members</h4>
                                    <p>Want to know the new comers? We provide it for you!</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <div class="media">
                                <div class="pull-left">
                                    <i class="fa fa-newspaper-o"></i>
                                    <div class="border"></div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Tons of articles</h4>
                                    <p>Feels bored? Enjoy our articles in your spare time!</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <div class="media">
                                <div class="pull-left">
                                    <i class="fa fa-comments"></i>
                                    <div class="border"></div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Interaction with others</h4>
                                    <p>Exchange your opinion through our forum!</p>
                                </div>
                            </div>
                        </div>
                    
                </div><!-- /.row -->
            
            </div><!-- /.container -->
        </section>
        <!-- End Feature Section -->
    
    
    
    <!-- Start Fun Facts Section -->
    <section class="fun-facts">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="counter-item">
                    <i class="fa fa-users"></i>
                    <div class="timer" id="item4" data-to="{{count($homedata[1])}}" data-speed="2500"></div>
                    <h5>Members</h5>                               
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="counter-item">
                    <i class="fa fa-newspaper-o"></i>
                    <div class="timer" id="item2" data-to="{{count($homedata[0])}}" data-speed="2500"></div>
                    <h5>Articles</h5>                               
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="counter-item">
                    <i class="fa fa-comments"></i>
                    <div class="timer" id="item3" data-to="{{count($homedata[2])}}" data-speed="2500"></div>
                    <h5>Questions</h5>                               
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Fun Facts Section -->



    <!-- Start Team Member Section -->
    <section id="team" class="team-member-section">
        <div class="container">            
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title text-center">
                        <h3>Our New Members</h3>
                        <p>Meet our new members!</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div id="team-section">
                        <div class="our-team">
                            @if (count($homedata[1]) > 0)
                                <div class="team-member">
                                    <img src="/storage/profile_image/{{$homedata[1][0]->profile_image}}" class="img-responsive" alt="">
                                    <div class="team-details">
                                        <h4>{{$homedata[1][0]->name}}</h4>
                                        <p>Alumni of STEI</p>
                                        <ul>
                                        @if ((Auth::user() != null) || (Auth::guard('member')->user() != null))
                                            <li><a href="/members/{{$homedata[1][0]->id}}"><i class="fa fa-user"></i></a></li>
                                        @else
                                            <li class="popup" onclick="myFunction()">
                                                <span class="popuptext" id="myPopup">You must login first <a href="/login"><u>(LOGIN)</u></a></span>
                                                <i class="fa fa-user show-profile-icon-team-details"></i></li>
                                        @endif
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @if (count($homedata[1]) > 1)
                                <div class="team-member">
                                    <img src="/storage/profile_image/{{$homedata[1][1]->profile_image}}" class="img-responsive" alt="">
                                    <div class="team-details">
                                        <h4>{{$homedata[1][1]->name}}</h4>
                                        <p>Alumni of STEI</p>
                                        <ul>
                                        @if ((Auth::user() != null) || (Auth::guard('member')->user() != null))
                                            <li><a href="/members/{{$homedata[1][1]->id}}"><i class="fa fa-user"></i></a></li>
                                        @else
                                            <li class="popup" onclick="myFunction2()">
                                                <span class="popuptext" id="myPopup2">You must login first <a href="/login"><u>(LOGIN)</u></a></span>
                                                <i class="fa fa-user show-profile-icon-team-details"></i></li>
                                        @endif
                                        </ul>
                                    </div>
                                </div>   
                            @endif
                    
                            @if (count($homedata[1]) > 2)
                                <div class="team-member">
                                    <img src="/storage/profile_image/{{$homedata[1][2]->profile_image}}" class="img-responsive" alt="">
                                    <div class="team-details">
                                        <h4>{{$homedata[1][2]->name}}</h4>
                                        <p>Alumni of STEI</p>
                                        <ul>
                                        @if ((Auth::user() != null) || (Auth::guard('member')->user() != null))
                                            <li><a href="/members/{{$homedata[1][2]->id}}"><i class="fa fa-user"></i></a></li>
                                        @else
                                            <li class="popup" onclick="myFunction3()">
                                                <span class="popuptext" id="myPopup3">You must login first <a href="/login"><u>(LOGIN)</u></a></span>
                                                <i class="fa fa-user show-profile-icon-team-details"></i></li>
                                        @endif
                                        </ul>
                                    </div>
                                </div>          
                            @endif
                        
                            @if (count($homedata[1]) > 3)
                                <div class="team-member">
                                    <img src="/storage/profile_image/{{$homedata[1][3]->profile_image}}" class="img-responsive" alt="">
                                    <div class="team-details">
                                        <h4>{{$homedata[1][3]->name}}</h4>
                                        <p>Alumni of STEI ITB</p>
                                        <ul>
                                        @if ((Auth::user() != null) || (Auth::guard('member')->user() != null))
                                            <li><a href="/members/{{$homedata[1][3]->id}}"><i class="fa fa-user"></i></a></li>
                                        @else
                                            <li class="popup" onclick="myFunction4()">
                                                <span class="popuptext" id="myPopup4">You must login first <a href="/login"><u>(LOGIN)</u></a></span>
                                                <i class="fa fa-user show-profile-icon-team-details"></i></li>
                                        @endif
                                        </ul>
                                    </div>
                                </div>          
                            @endif

                            @if (count($homedata[1]) > 4)
                                <div class="team-member">
                                    <img src="/storage/profile_image/{{$homedata[1][4]->profile_image}}" class="img-responsive" alt="">
                                    <div class="team-details">
                                        <h4>{{$homedata[1][4]->name}}</h4>
                                        <p>Alumni of STEI ITB</p>
                                        <ul>
                                        @if ((Auth::user() != null) || (Auth::guard('member')->user() != null))
                                            <li><a href="/members/{{$homedata[1][4]->id}}"><i class="fa fa-user"></i></a></li>
                                        @else
                                            <li class="popup" onclick="myFunction5()">
                                                <span class="popuptext" id="myPopup5">You must login first <a href="/login"><u>(LOGIN)</u></a></span>
                                                <i class="fa fa-user show-profile-icon-team-details"></i></li>
                                        @endif
                                        </ul>
                                    </div>
                                </div>          
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Team Member Section -->
    
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h3>Contact With Us</h3>
                        <h5 class="white-text lowercase"><strong>sisfo@std.stei.itb.ac.id</strong></h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-contact-info">
                        <h4>Contact info</h4>
                        <ul>
                            <li><strong>E-mail :</strong> sisfo@std.stei.itb.ac.id</li>
                            <!--<li><strong>Phone :</strong> +62-22-2502260</li>-->
                            <br>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="footer-contact-info">
                        <h4>Working Hours</h4>
                        <ul>
                            <li><strong>Mon-Fri :</strong> 8 am to 5 pm</li>
                            <li><strong>Sat-Sunday :</strong> Closed</li>
                            <br>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    // When the user clicks on div, open the popup
    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }

    function myFunction2() {
        var popup = document.getElementById("myPopup2");
        popup.classList.toggle("show");
    }

    function myFunction3() {
        var popup = document.getElementById("myPopup3");
        popup.classList.toggle("show");
    }

    function myFunction4() {
        var popup = document.getElementById("myPopup4");
        popup.classList.toggle("show");
    }

    function myFunction5() {
        var popup = document.getElementById("myPopup5");
        popup.classList.toggle("show");
    }
    </script>
</body>
@endsection