<!-- Navigation -->
@if (Request::is('/') || Request::is('about'))
    <nav class="navbar navbar-default navbar-fixed-top">
@else
    <nav class="navbar navbar-default" style="background-color: #222; padding: 1% 0;">
@endif
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @if (Request::is('/'))
                <a class="navbar-brand page-scroll" href="#page-top">Alumni STEI</a>
            @else
                <a class="navbar-brand page-scroll" href="/">Alumni STEI</a>
            @endif
            
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>   
                <li>
                    @if (Request::is('/'))
                        {{-- nothing --}}
                    @else
                        <a href="/">Home</a>
                    @endif
                </li>

                {{-- Article --}}
                @if(Request::is('article'))
                    <li class="on-page">
                        <a href="#">Article</a>
                    </li>
                @else
                    <li>
                        <a href="/article">Article</a>
                    </li>
                @endif

                {{-- Forum --}}
                @if(Auth::guard('member')->user() != null)
                    @if(Request::is('forum/')) <!-- URL Forum -->
                        <li class="on-page">
                            <a href="#">Forum</a>
                        </li>
                    @else
                        <li>
                            <a class="" href="/forum">Forum</a>
                        </li>
                    @endif
                @endif
                @if (Request::is('about'))
                    <li class="on-page">
                        <a href="#">About</a>
                    </li>
                @else
                    <li>
                        <a class="page-scroll" href="/about">About</a>
                    </li>
                @endif
                <li>
                    @if (Request::is('/'))
                        <a class="page-scroll" href="#service">Services</a>
                    @endif       
                </li>
                <li>
                    @if (Request::is('/'))
                        <a class="page-scroll" href="#team">New member</a>
                    @endif                       
                </li>
                <li>
                    @if (Request::is('/'))
                        <a class="page-scroll" href="#contact">Contact</a>
                    @endif        
                </li>
            </ul>

            <!-- Login Dropdown -->
            <ul class="navbar-nav ml-auto navbar-right" style="margin-top: 1.25%">
                <!-- Authentication Links -->
                @guest
                    @if(Auth::guard('member')->user() != null)
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle login" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{Auth::guard('member')->user()->name}}</span>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="/profilemember/{{Auth::guard('member')->user()->id}}">
                                    {{-- <a class="dropdown-item" href="/profilemember/{{Auth::guard('member')->user()->id}}"> --}}
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/logout"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="/logout" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <a class="login" href="/login">Login</a>
                    @endif
                    
                    <!-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> -->
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}</span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

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