@extends('layouts.app')

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

            <table class="table" style="border-width:0px;">
                <tbody>
                    <tr>
                        <div class="form-group">
                                <td>{{Form::label('draft', 'Save As Draft')}}</td>
                                <td>
                                    <label class="switch">
                                        <input name="draft" id="draft" value="yes" type="checkbox" checked>
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
                                        <input name="public" id="public" value="yes" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                        </div>
                    </tr>
                </tbody>
            </table>

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