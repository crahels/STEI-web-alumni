@extends('layouts.apphome')

@section('content')
<div class="body-qna">
    <section class="services-section text-center">
        <div class="section-title">
            @if ($answer->is_admin == 1)
                <h3>&nbsp;{{$answer->user->name}}'s Answer </h3>
            @else
                <h3>&nbsp;{{$answer->member->name}}'s Answer </h3>
            @endif
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
                        <td style="word-wrap: break-word;">:&nbsp;{{$answer->question->topic}}</td>
                    </tr>
                        <td>Question's Body</td>
                        <td style="word-wrap: break-word;">:&nbsp;{{$answer->question->body}}</td>                            
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
                        <td>:&nbsp;{{$answer->created_at->format('d M Y')}}</td>
                    </tr>
                    <tr>
                        <td>Last Editted On</td>
                        <td>:&nbsp;{{$answer->updated_at->format('d M Y')}}</td>
                    </tr>
                    <tr>
                        <td>Written By</td>
                        @if ($answer->is_anon == 1)
                            <td>:&nbsp;Anonymous</td>
                        @else
                            @if ($answer->is_admin == 0)
                                <td>:&nbsp;{{$answer->member->name}}</td>
                            @else
                                <td>:&nbsp;{{$answer->user->name}} as <span style="color:blue;">admin</span></td>
                            @endif
                        @endif
                    </tr>
                <tbody>
            </table>

        @if((!Auth::guest() && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && $answer->member_id == Auth::guard('member')->user()->id && $answer->is_admin == 0))
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
