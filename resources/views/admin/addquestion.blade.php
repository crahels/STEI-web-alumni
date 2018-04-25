@extends('layouts.app')

@section('title', 'Add Question')

@section('content')
<div class="row create-post-container">
    <div class="col-3 header-create-post">
        <h1>Add <br>Question </h1>
    </div>
    <div class="col-8 post">
        {!! Form::open(['action' => 'QuestionsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('topic', 'Topic')}}
                {{Form::text('topic', '', ['class' => 'form-control', 'placeholder' => 'Topic'])}}
            </div>
            <div class="form-group" style="width:30%;">
                <div style="float:left;">{{Form::label('anon', 'Anonymous')}}&nbsp;&nbsp;&nbsp;</div>
                <div class="pull-right">
                    <label class="switch">
                        <input name="anon" id="anon" value="yes" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="form-group" style="clear:both;">
                {{Form::label('body', 'Question')}}
                {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Question'])}}
            </div>
            <div class="bottomButton">
                {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
                <a onclick="return confirm('Are you sure you want to leave?')" class="pull-right onclick btn btn-danger" href="/admin/questions">
                    Cancel
                </a>
            </div>
        {!! Form::close() !!}
    </div>        
</div>
@endsection