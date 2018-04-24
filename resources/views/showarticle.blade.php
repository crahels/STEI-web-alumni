@extends('layouts.apphome')

@section('title', 'Posts')

@section('content')
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
  <span>
        <h1 class="post-title">{{$post->title}}</h1>
        <h5 class="post-title">&nbsp;
            @if ($post->draft == '1')
                <span style="color:red;">Draft</span>
            @else
                <span style="color:green;">Published</span>
            @endif
        </h5>
    </span>  
    
    <div class="body-article">
        {!!$post->body!!}
    </div>

    <div class="footer-article">
        <hr>
        <h5>
            @if ($post->public == '1')
                Public 
            @else
                Private 
            @endif  
            Post
        </h5>
        <small>Written on {{$post->created_at}}</small><br>
        <small>Last Editted on {{$post->updated_at}}</small><br>
        <small>by {{$post->user->name}}</small>
        <hr>

        @if(!Auth::guest() &&  Auth::user()->IsAdmin == 1)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
            {!!Form::close() !!}
        @endif
        <br><br><br>
        <a href="/posts" class="btn btn-info pull-down">&#8592; Back</a>
        
    </div>
  </main>

@endsection