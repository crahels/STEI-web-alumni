@extends('layouts.apphome')

@section('title', 'Add Question')

@section('content')
<div class="body-qna">
    <section class="services-section text-center">
        <div class="section-title">
            <h3> Add Question </h3>
        </div>
    </section>
    <div class="qna-container">
        <div class="add-question-container" style="margin: 0px 300px">
            {!! Form::open(['action' => 'QuestionsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('topic', 'Topic')}}
                    {{Form::text('topic', '', ['class' => 'form-control', 'placeholder' => 'Topic'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Question')}}
                    {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Question'])}}
                </div>
                <div class="form-group">
                    <div style="float:left;">{{Form::label('anon', 'Anonymous')}}&nbsp;&nbsp;&nbsp;</div>
                    <label class="switch">
                        <input name="anon" id="anon" value="yes" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
                <div>
                    {{Form::submit('Submit', ['class' => 'btn btn-primary pull-left'])}}
                    <a onclick="return confirm('Are you sure you want to leave?')"
                    class="pull-left onclick btn btn-danger" href="/questions"
                    style="margin-left: 20px">
                        Cancel
                    </a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
