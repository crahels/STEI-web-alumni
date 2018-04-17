@extends('layouts.app')

@section('content')
  
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
            <a href="/admin/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
            {!!Form::close() !!}
        @endif
        <br><br><br>
        <a href="/admin/posts" class="btn btn-info pull-down">&#8592; Back</a>
        
    </div>
@endsection