@extends('layouts.app')

@section('content')
    @if ($post->cover_image !== 'noimage.jpg')   
        <div class="row">
            <div class="col-8">
                <h1>{{$post->title}}</h1>
                <h3>By {{$post->user->name}}</h3>
                <hr>
                <div>
                    {!!$post->body!!}
                </div>
                <hr>
                    <i>Created on {{$post->created_at}}</i>
                <hr>
                <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
                {!!Form::close() !!}
                <a href="/posts" class="btn btn-info pull-down">&#8592; Back</a>
            </div>
            <div class="col-4 post-view-img">
                <img src="/storage/cover_images/{{$post->cover_image}}">
            </div>
        </div>
    @else
    <h1>{{$post->title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
    {!!Form::close() !!}
    <a href="/posts" class="btn btn-info pull-down">&#8592; Back</a>
    @endif
@endsection