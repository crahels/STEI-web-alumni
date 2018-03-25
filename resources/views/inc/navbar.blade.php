  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light ">
      <div class="container">
          <img src="{{URL::asset('storage/logo_itb.png')}}" alt="logo_ins">
          <a class="navbar-brand" href="/">
              <i style="font-weight: lighter; font-style: initial; font-size: 1.3em">Web Alumni</i>
              <b style="font-size: 1.5em">STEI</b>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left Side Of Navbar -->
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Home<span class="sr-only">(current)</span></a>
                  </li>
                  @if(!Auth::guest() &&  Auth::user()->IsAdmin == 1)
                  <li class="nav-item">
                    <a class="nav-link" href="/members">Members</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/posts">Articles</a>
                  </li>
                  @endif
                </ul>

              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ml-auto navbar-right">
                  <!-- Authentication Links -->
                  @guest
                      <!-- <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login Admin') }}</a></li> -->
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
      </div>
  </nav>
