@extends('layouts.app')

@section('title', 'Edit Post')

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

            <table class="table" style="border-width:0px;">
                <tbody>
                    <tr>
                        <div class="form-group">
                                <td>{{Form::label('draft', 'Save As Draft')}}</td>
                                <td> 
                                    <label class="switch">
                                        @if ($post->draft == '1')
                                            <input name="draft" id="draft" value="yes" type="checkbox" checked>
                                        @else
                                            <input name="draft" id="draft" value="yes" type="checkbox">
                                        @endif
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                                <td>{{Form::label('public', 'Save As Public')}}</td>
                                <td>
                                    <label class="switch">
                                        @if ($post->public == '1')
                                            <input name="public" id="public" value="yes" type="checkbox" checked>
                                        @else
                                            <input name="public" id="public" value="yes" type="checkbox">
                                        @endif
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                        </div>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', $post->body, ['class' => 'form-control', 'id' => 'article-ckeditor', 'placeholder' => 'Body'])}}
            </div>

            <div class="form-group">
                {{Form::label('cover_image', 'Thumbnail')}}
                {{Form::file('cover_image')}}
            </div>

            {{Form::hidden('_method', 'PUT')}}
            <div class="bottomButton">
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                <a onclick="return confirm('Are you sure you want to leave?')" class="onclick btn btn-danger pull-right" href="/posts/{{$post->id}}">
                    Cancel
                </a>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection