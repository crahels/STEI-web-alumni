@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('inc.adminmenu')
    <main role="main" class="col-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Posts List</h1>
            <a class="btn btn-primary" href="/posts/create">
                Create Post
            </a>
        </div>
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div class="well">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
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