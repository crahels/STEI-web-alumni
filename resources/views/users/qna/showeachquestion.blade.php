@extends('layouts.apphome')

@section('content')
<div class="body-qna">
    <div class="container qna-container">
        <div class="row">
            <div class="col-2"></div>
                <div class="well question-container col-8" style="margin-top: 40px">
                    <div class="qna-content" style="margin-left: 20px">
                        <h1 style="word-wrap: break-word;">{{$question->topic}}</h1>
                        <div class="body-article" style="font-size:1.5em; word-wrap: break-word;">{{$question->body}}</div>
                        <div class="footer-article"><hr>
                            <small>Written on {{$question->created_at}}</small><br>
                            <small>Last Editted on {{$question->updated_at}}</small><br>
                            <small>
                                @if ($question->is_anon == 1)
                                    by Anonymous
                                @else
                                    @if ($question->is_admin == 1)
                                        by {{$question->user->name}} as <span style="color:blue;">admin</span>
                                    @else
                                        by <a href="/members/{{$question->member->id}}">{{$question->member->name}}</a>
                                    @endif
                                @endif
                            </small>
                        </div>
                        @if((!Auth::guest() && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && $question->member_id == Auth::guard('member')->user()->id && $question->is_admin == 0))
                            <div style="margin-top: 20px">
                                <a href="/questions/{{$question->id}}/edit" class="pull-left btn btn-warning">Edit</a>
                                {!!Form::open(['action' => ['QuestionsController@destroy', $question->id], 'method' => 'POST', 'class' => 'pull-left', 'style' => 'margin-left: 20px'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
                                {!!Form::close() !!}
                            </div>
                        @endif
                    </div>
                    <br><br>
                    <div id="answercontainer-{{$question->id}}" class="col-12 post-card">
                        <div id="add-answer">
                            <hr>
                            {!! Form::open(['action' => ['AnswersController@store', 1], 'method' => 'POST']) !!}
                            <div class="form-group">
                                {{Form::label('body','Answer')}}
                                {{Form::text('body', '', ['class' => 'form-control'])}}
                            </div>
                            {{ Form::hidden('question_id', $question->id) }}
                            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                                <!-- <a onclick="return confirm('Are you sure you want to cancel?')" href="/admin/questions" class="btn btn-danger pull-right">Cancel</a> -->
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div id="answers-{{$question->id}}" class="row">
                        @foreach ($question->answers->sortByDesc('rating')->sortByDesc('is_pinned') as $answer)
                        <div class="col-12 post-card">
                            <hr>
                            <div class="col-3" style="float:left;">
                                <center>
                                    <small style="font-size:1.1em;">vote<span>@if($answer->rating > 1)<span>s</span>@endif</span>
                                    </small><br>
                                    <span class="sum-rating">
                                        {{$answer->rating}}
                                    </span>
                                    @if(Auth::guard('member')->user() != null)
                                        {!! Form::open(['action' => ['AnswersController@giveRating', $answer->id, Auth::guard('member')->user()->id, 1], 'method' => 'POST']) !!}
                                        @if ($answer->members->contains(Auth::guard('member')->user()->id)) 
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
                                <p style="word-wrap: break-word;">{{$answer->body}}</p>
                                <a href="/answers/{{$answer->id}}">
                                    <small>
                                        Written on {{$answer->created_at}}<br> 
                                        @if ($answer->is_admin == 1)
                                            by {{$answer->user->name}} as <span style="color:blue;">admin</span>
                                        @else
                                            by <a href="/members/{{$answer->member->id}}">{{$answer->member->name}}</a>
                                        @endif
                                    </small>
                                </a>
                                <br>
                                @if ($answer->created_at != $answer->updated_at)
                                    <small style="color:green;">(edited)</small>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                </div>
            <div class="col-2"></div>
        </div>
    </div>
</div>
@endsection
