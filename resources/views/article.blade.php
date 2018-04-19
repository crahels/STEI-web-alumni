@extends('layouts.apphome')

@section('title', 'Posts')

@section('content')

<br> <br> <br> <br> <br> <br>
<div class="container-fluid">
  <div class="row">
    <nav class="col-3 sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item" id="nav-two">
            <a class="nav-link" href="/members">
              <span id="text-nav-two">
                <span data-feather="users"></span>
                <i class="sideMenu">Members</i>
              </span>    
            </a>
          </li>
          <li class="nav-item" id="nav-one">
            <a class="nav-link" href="/forum">
              <span id="text-nav-one">  
                <span data-feather="home"></span>
                <i class="sideMenu">Forum</i><span class="sr-only">(current)</span>
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
        </ul>
      </div>
    </nav>
  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace();
  </script>
    <main role="main" class="col-7">
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div class="well">
                    <div class="row">
                        <div class="col-8 post-card">
                            <h3><a href="/admin/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <i>Written on {{$post->created_at}} by {{$post->user->name}}</i>
                        </div>
                        <div class="col-4 img-card">
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                        </div>
                    </div>
                </div>
            @endforeach
            <ul class="pagination pull-right">{{$posts->links()}}</ul>
        @else
            <p>No post</p>
        @endif
    </main>
</div>
</div>
<script>
    document.getElementById("nav-three").classList.add("active");
    document.getElementById("text-nav-three").classList.add("color-active");
</script>	

@endsection