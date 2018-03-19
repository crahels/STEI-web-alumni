@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
      <div class="row">
        <nav class="col-3 sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="/dashboard">
                    <span data-feather="home"></span>
                    <i class="sideMenu">Dashboard</i><span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/members">
                    <span data-feather="users"></span>
                    <i class="sideMenu">Members List</i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/dashboard/#">
                    <span data-feather="file"></span>
                    <i class="sideMenu">Articles</i>
                  </a>
                </li>
              </ul>
            </div>
          </nav>

        <main role="main" class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <img src="{{URL::asset('storage/banner.jpg')}}" id="bannerMember">
            </div>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <h1 class="h2">What to Show</h1>
            </div>
          </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
</html>
@endsection
