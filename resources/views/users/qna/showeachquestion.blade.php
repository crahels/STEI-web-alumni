@extends('layouts.app')

@section('content')
<div class="row show-question">
    <div class="col-3 edit-question left-question">
        <h1 >{{$question->topic}}</h1>

        <div class="body-article" style="font-size:1.5em;">
            {{$question->body}}
        </div>

        <div class="footer-article">
            <hr>
            <small>Written on {{$question->created_at}}</small><br>
            <small>Last Editted on {{$question->updated_at}}</small><br>
            <small>by {{$question->user->name}}</small>
            <hr>
        </div>
        @if((!Auth::guest() && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && $question->user()->id == Auth::guard('member')->user()->id && $question->is_admin == 0))
            <a href="/questions/{{$question->id}}/edit" class="btn btn-warning">
                Edit
            </a>
            {!!Form::open(['action' => ['QuestionsController@destroy', $question->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
            {!!Form::close() !!}
        @endif<br><br>
    </div>
    <div class="col-9">
        <h4>Answers:</h4>
        <div class="">
            <div id="answers-{{$question->id}}" class="row">
                @foreach ($question->answers->sortByDesc('rating')->sortByDesc('is_pinned') as $answer)
                    <div class="col-9 post-card">
                        <hr>
                        <div class="col-3" style="float:left;">
                            <center>
                                <small style="font-size:1.1em;">vote<span>@if($answer->rating > 1)<span>s</span>@endif</span>
                                </small><br>
                                <span class="sum-rating">
                                    {{$answer->rating}}
                                </span>
                                @if(Auth::guard('member')->user() != null)
                                    {!! Form::open(['action' => ['AnswersController@giveRating', $answer->id, Auth::guard('member')->user()->id], 'method' => 'POST']) !!}
                                    @if ($answer->users->contains(Auth::guard('member')->user()->id)) 
                                        {{Form::submit('VOTE', ['class' => 'btn'])}}
                                    @else
                                        {{Form::submit('VOTE', ['class' => 'btn btn-warning'])}}
                                    @endif
                                @else
                                    {!! Form::open(['action' => ['AnswersController@givePin', $answer->id, $question->id, 1], 'method' => 'POST']) !!}
                                    @if($answer->is_pinned == 1) 
                                        {{Form::button('<i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PINNED', ['type' => 'submit', 'class' => 'btn', 'data-toggle' => 'tooltip'])}}
                                        
                                    @else
                                        {{Form::button('<i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PIN', ['type' => 'submit', 'class' => 'btn btn-warning', 'data-toggle' => 'tooltip'])}}
                                    @endif
                                @endif
                                {!! Form::close() !!}
                            </center>
                        </div>

                        <div class="col-12">
                            <p>{{$answer->body}}</p>
                            <a href="/answers/{{$answer->id}}">
                                <small>
                                    Written on {{$answer->created_at}} by {{$answer->user->name}} <span>@if($answer->is_admin == 1)<span>as <span style="color:blue;">admin</span></span>@endif</span>
                                </small>
                            </a>
                            <br>
                            @if ($answer->created_at != $answer->updated_at)
                                <small style="color:green;">(edited)</small>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                <div id="answercontainer-{{$question->id}}" class="col-9 post-card">
                    <div id="add-answer">
                        <hr>
                        {!! Form::open(['action' => ['AnswersController@store', 1], 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::label('body','Answer')}}
                            {{Form::text('body', '', ['class' => 'form-control'])}}
                        </div>
                        {{ Form::hidden('question_id', $question->id) }}
                        {{Form::submit('Submit', ['class' => 'btn btn-primary pull-right'])}}
                            <!--<a onclick="return confirm('Are you sure you want to cancel?')" href="/admin/questions" class="btn btn-danger pull-right">Cancel</a>-->
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    <!--<br><br><br>
    <a href="/admin/questions" class="btn btn-info pull-down">&#8592; Back</a>-->
    </div>
</div>
@endsection