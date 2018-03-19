  <link rel="stylesheet" type="text/css" href="css/style.css">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
          <img src="res/logo_itb.png">
          <a class="navbar-brand" href="/">Web Alumni STEI</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left Side Of Navbar -->
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/members">Members</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">TBD</a>
                  </li>
                </ul>

              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ml-auto navbar-right">
                  <!-- Authentication Links -->
                  @guest
                      <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login Admin') }}</a></li>
                      <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
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
