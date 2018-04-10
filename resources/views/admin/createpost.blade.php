@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="row create-post-container">
    <div class="col-3 header-create-post">
        <h1>Create<br>Post</h1>
    </div>
    <div class="col-8 post">
        {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body'])}}
            </div>
            <div class="form-group">
                {{Form::file('cover_image')}}
            </div>
            <div class="bottomButton">
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                <a onclick="return confirm('Are you sure you want to leave?')" class="pull-right onclick btn btn-danger" href="/posts">
                    Cancel
                </a>
            </div>
        {!! Form::close() !!}
    </div>        
</div>
@endsection