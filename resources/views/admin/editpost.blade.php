@extends('layouts.app')

@section('content')
<div class="row create-post-container">
    <div class="col-3 header-create-post">
        <h1>Edit <br>Post</h1>
    </div>
    <div class="col-8 post">
        {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>

            <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', $post->body, ['class' => 'form-control', 'id' => 'article-ckeditor', 'placeholder' => 'Body'])}}
            </div>

            <div class="form-group">
                {{Form::label('cover_image', 'Thumbnail')}}
                {{Form::file('cover_image')}}
            </div>
            
            <div class="form-group">
                {{Form::label('draft', 'Save As Draft')}}
                <div class="btn-group btn-toggle"> 
                    <button name="draft_yes" id="draft_yes" class="no_default btn btn-xs btn-default active" value="1">Yes</button>
                    <button name="draft_no" id="draft_no" class="no_default btn btn-xs btn-primary" value="1">No</button>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('public', 'Save As Public')}}
                <div class="btn-group btn-toggle"> 
                    <button name="public_yes" id="public_yes" class="no_default btn btn-xs btn-default active" value="1">Yes</button>
                    <button name="public_no" id="public_no" class="no_default btn btn-xs btn-primary" value="1">No</button>
                </div>
            </div>
            
            {{Form::hidden('_method', 'PUT')}}
            <div class="bottomButton">
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                <a onclick="return confirm('Are you sure you want to leave?')" class="onclick btn btn-danger pull-right" href="/posts">
                    Cancel
                </a>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $('.no_default').click(function(event) {
        event.preventDefault();
    });

    $('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');

        if ($(this).find('.btn-primary').length > 0) {
            $(this).find('.btn').toggleClass('btn-primary');
        }
        if ($(this).find('.btn-danger').length > 0) {
            $(this).find('.btn').toggleClass('btn-danger');
        }
        if ($(this).find('.btn-success').length > 0) {
            $(this).find('.btn').toggleClass('btn-success');
        }
        if ($(this).find('.btn-info').length > 0) {
            $(this).find('.btn').toggleClass('btn-info');
        }

        $(this).find('.btn').toggleClass('btn-default');
    });
</script>
@endsection