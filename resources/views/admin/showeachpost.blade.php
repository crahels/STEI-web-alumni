@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    @if ($post->cover_image !== 'noimage.jpg')   
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
            </div>
        </div>
        <br><br>
    @endif
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
    <br><br><br>
    <a href="/posts" class="btn btn-info pull-down">&#8592; Back</a>
@endsection