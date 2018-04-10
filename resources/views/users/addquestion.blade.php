@extends('layouts.app')

@section('content')
<div class="row create-post-container">
    <div class="col-3 header-create-post">
        <h1>Add<br>Question</h1>
    </div>
    <div class="col-8 post">
        {!! Form::open(['action' => 'QuestionsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('topic', 'Topic')}}
                {{Form::text('topic', '', ['class' => 'form-control', 'placeholder' => 'Topic'])}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Question')}}
                {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Question'])}}
            </div>
            <div class="bottomButton">
                {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
                <a onclick="return confirm('Are you sure you want to leave?')" class="pull-right onclick btn btn-danger" href="/questions">
                    Cancel
                </a>
            </div>
        {!! Form::close() !!}
    </div>        
</div>
@endsection