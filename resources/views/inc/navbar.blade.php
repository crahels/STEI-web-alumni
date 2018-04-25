<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light ">
    <div class="container">
        <img src="{{URL::asset('storage/logo_itb.png')}}" alt="logo_ins">
        <a class="navbar-brand" href="/admin/dashboard">
            <i style="font-weight: lighter; font-style: initial;" class="web-alumni">Web Alumni</i>
            <b class="stei">STEI</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

          <div class="collapse navbar-collapse" style="margin-left:4%;" id="navbarSupportedContent">
              <!-- Left Side Of Navbar -->
              <ul class="navbar-nav mr-auto">
                @if(Auth::guard('member')->user() != null)
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/members/{{Auth::guard('member')->user()->id}}">Profile</span></a>
                    </li>
                @endif
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/dashboard">Dashboard<span class="sr-only">(current)</span></a>
                  </li>
                  @if(!Auth::guest() &&  Auth::user()->IsAdmin == 1)
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/members">Members</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/posts">Posts</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="/admin/questions">Questions</a>
                      </li>
                  @endif
                </ul>

              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ml-auto navbar-right">
                  <!-- Authentication Links -->
                  @guest
                    @if(Auth::guard('member')->user() != null)
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span>{{Auth::guard('member')->user()->name}}</span>
                            </a>
  
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/logout"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
  
                                <form id="logout-form" action="/logout" method="GET" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li><a class="login" href="/admin/login">{{ __('Login') }}</a></li>
                    @endif
                      
                      <!-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> -->
                  @else
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" name="dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              <span>{{ Auth::user()->name }}</span>
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
    </div>
</nav>
