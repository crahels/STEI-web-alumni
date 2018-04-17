@extends('layouts.app')

@section('title', 'Edit Answer')

@section('content')
<div class="row create-post-container">
    <div class="col-3 header-create-post">
        <h1>Edit <br>Answer</h1>
    </div>
    <div class="col-8 post">
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
                    <div class="form-group">
                            <td>{{Form::label('pin', 'Pin')}}</td>
                            <td> 
                                <label class="switch">
                                    @if ($answer->is_pinned == '1')
                                        <input name="pin" id="pin" value="yes" type="checkbox" checked>
                                    @else
                                        <input name="pin" id="pin" value="yes" type="checkbox">
                                    @endif
                                    <span class="slider round"></span>
                                </label>
                            </td>
                    </div>
                </tr>
                <tr>
                    <td>{{Form::label('body', "Answer's Body")}}</td>
                    <td>{{Form::textarea('body', $answer->body, ['class' => 'form-control', 'placeholder' => 'Answer'])}}</td>
                </tr>
            </tbody>
        </table>
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