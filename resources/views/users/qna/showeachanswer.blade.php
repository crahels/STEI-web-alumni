@extends('layouts.apphome')

@section('content')
<div class="body-qna">
    <section class="services-section text-center">
        <div class="section-title">
            <h3>&nbsp;{{$answer->member->name}}'s Answer </h3>
        </div>
    </section>
    <div class="qna-container">
        <div class="add-question-container" style="margin: 0px 300px">
            @if($answer->is_pinned == 1)
                <button data-toggle="tooltip" class="btn pull-right"><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PINNED</button> 
            @else
                <button data-toggle="tooltip" class="btn btn pull-right"><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;NOT PINNED</button>
            @endif
            <br>
            <br>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Topic</td>
                        <td>:&nbsp;{{$answer->question->topic}}</td>
                    </tr>
                        <td>Question's Body</td>
                        <td>:&nbsp;{{$answer->question->body}}</td>                            
                    </tr>
                    <tr>
                        <td>Answer's Body</td>
                        <td>:&nbsp;{{$answer->body}}</td>
                    </tr>
                    <tr>
                        <td>Votes</td>
                        <td>:&nbsp;{{$answer->rating}}</td>
                    </tr>
                    <tr>
                        <td>Written On</td>
                        <td>:&nbsp;{{$answer->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Last Editted On</td>
                        <td>:&nbsp;{{$answer->updated_at}}</td>
                    </tr>
                    <tr>
                        <td>Written By</td>
                        <td>:&nbsp;{{$answer->member->name}}<span>@if($answer->is_admin == 1) <span>as <span style="color:blue;">admin</span></span>@endif</span></td>
                    </tr>
                <tbody>
            </table>

        @if((!Auth::guest() && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && $answer->member->id == Auth::guard('member')->user()->id && $answer->is_admin == 0))
            <a href="/answers/{{$answer->id}}/edit" class="pull-left btn btn-warning" style="margin-right: 10px">
                Edit
            </a>
            {!!Form::open(['action' => ['AnswersController@destroy', $answer->id], 'method' => 'POST', 'class' => 'pull-left'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
            {!!Form::close() !!}
        @endif
        </div>
    </div>
</div>
@endsection