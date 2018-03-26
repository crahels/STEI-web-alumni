@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('inc.adminmenu')
    <main role="main" class="col-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">List of Posts</h1>
            <a class="btn btn-primary" href="/posts/create">
                Create Post
            </a>
        </div>
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
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