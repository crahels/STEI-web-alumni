<div class="container-fluid">
  <div class="row">
    <nav class="col-3 sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item" id="nav-one">
            <a class="nav-link" href="/dashboard">
              <span id="text-nav-one">  
                <span data-feather="home"></span>
                <i class="sideMenu">Dashboard</i><span class="sr-only">(current)</span>
              </span>    
            </a>
          </li>
          <li class="nav-item" id="nav-two">
            <a class="nav-link" href="/members">
              <span id="text-nav-two">
                <span data-feather="users"></span>
                <i class="sideMenu">Members</i>
              </span>    
            </a>
          </li>
          <li class="nav-item" id="nav-three">
            <a class="nav-link" href="/posts">
              <span id="text-nav-three">
                <span data-feather="file"></span>
                <i class="sideMenu">Posts</i>
              </span>
            </a>
          </li>
          <li class="nav-item" id="nav-four">
            <a class="nav-link" href="/questions">
              <span id="text-nav-four">
                <span data-feather="help-circle"></span>
                <i class="sideMenu">Questions</i>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  <!-- Icons -->
  <!--<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>-->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace();
  </script>