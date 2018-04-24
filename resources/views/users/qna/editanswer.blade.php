@extends('layouts.apphome')

@section('title', 'Edit Answer')

@section('content')
<div class="body-qna">
    <section class="services-section text-center">
        <div class="section-title">
            <h3> Edit Answer </h3>
        </div>
    </section>
    <div class="qna-container">
        <div class="add-question-container" style="margin: 0px 300px">
            {!! Form::open(['action' => ['AnswersController@update', $answer->id], 'method' => 'POST']) !!}
            <table class="table" style="border-width:0px;">
            <tbody>
                <tr>
                    <td>{{Form::label('topic', 'Topic')}}</td>
                    <td>{{$answer->question->topic}}</td>
                </tr>
                <tr>
                    <td>{{Form::label('question', "Question's Body")}}</td>
                    <td>{{$answer->question->body}}</td>
                </tr>
                <tr>
                    <td>{{Form::label('body', "Answer's Body")}}</td>
                    <td>{{Form::textarea('body', $answer->body, ['class' => 'form-control', 'placeholder' => 'Answer'])}}</td>
                </tr>
            </tbody>
            </table>
            {{Form::hidden('_method', 'PUT')}}
            <div class="bottomButton">
                {{Form::submit('Submit', ['class' => 'pull-left btn btn-primary'])}}
                <a onclick="return confirm('Are you sure you want to leave?')" class="onclick btn btn-danger pull-left" href="/answers/{{$answer->id}}" style="margin-left: 20px">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
