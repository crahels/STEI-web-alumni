@extends('layouts.app')

@section('title', 'Edit Answer')

@section('content')
<div class="row create-post-container">
    <div class="col-3 header-create-post">
        <h1>Edit <br>Answer</h1>
    </div>
    <div class="col-8 post">
        {!! Form::open(['action' => ['AnswersController@update', $answer->id], 'method' => 'POST']) !!}
            {{Form::label('question', 'Question')}}: 
            {!!$answer->question->body!!}
            <div class="form-group">
                {{Form::label('body', 'Answer')}}
                {{Form::textarea('body', $answer->body, ['class' => 'form-control', 'placeholder' => 'Answer'])}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            <div class="bottomButton">
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                <a onclick="return confirm('Are you sure you want to leave?')" class="onclick btn btn-danger pull-right" href="/admin/answers/{{$answer->id}}">
                    Cancel
                </a>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection