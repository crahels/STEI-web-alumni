@extends('layouts.apphome')

@section('title', 'Edit Question')

@section('content')
<div class="body-qna">
    <section class="services-section text-center">
        <div class="section-title">
            <h3> Edit Question </h3>
        </div>
    </section>
    <div class="qna-container">
        <div class="add-question-container" style="margin: 0px 300px">
            {!! Form::open(['action' => ['QuestionsController@update', $question->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('topic', 'Topic')}}
                {{Form::text('topic', $question->topic, ['class' => 'form-control', 'placeholder' => 'Topic'])}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Question')}}
                {{Form::textarea('body', $question->body, ['class' => 'form-control', 'placeholder' => 'Question'])}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            <div class="bottomButton">
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                <a onclick="return confirm('Are you sure you want to leave?')" class="onclick btn btn-danger pull-right" href="/questions/{{$question->id}}">
                    Cancel
                </a>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection