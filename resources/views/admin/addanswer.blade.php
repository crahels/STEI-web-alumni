@extends('layouts.app')

@section('title', 'Questions')

@section('content')

@include('inc.adminmenu') 
    <main role="main" class="col-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">List of Questions</h1>
        </div>
        @if (count($questions) > 0)
            @foreach ($questions as $question)
                <div class="well">
                    <div class="row">
                        <div class="col-12 post-card">
                            <h3><a href="/admin/questions/{{$question->id}}">{{$question->topic}}</a></h3>
                            <p>{!!$question->body!!}</p>
                            <small>
                                <i>
                                    Written on {{$question->created_at}} by {{$question->user->name}}
                                </i>
                            </small>
                            <br>
                            @if ($question->created_at != $question->updated_at)
                                <small style="color:green;">(edited)</small>
                            @endif
                            <a href="/admin/answers/add/{{$question->id}}" class="btn btn-primary" style="float:right;">
                                Give Answer
                            </a>
                        </div>

                        @foreach ($question->answers->sortByDesc('rating') as $answer)
                            <div class="col-12 post-card" style="display:inline;">
                                <hr>
                                <div class="col-3" style="float:left;">
                                    <div>
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
                                                @if($answer->is_pinned == 1) 
                                                    {!! Form::open(['action' => ['AnswersController@givePin', $answer->id], 'method' => 'POST']) !!}
                                                    {{Form::button('<i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PINNED', ['type' => 'submit', 'class' => 'btn', 'data-toggle' => 'tooltip'])}}
                                                    
                                                @else
                                                    {!! Form::open(['action' => ['AnswersController@givePin', $answer->id], 'method' => 'POST']) !!}
                                                    {{Form::button('<i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PIN', ['type' => 'submit', 'class' => 'btn btn-warning', 'data-toggle' => 'tooltip'])}}
                                                @endif
                                            @endif
                                            {!! Form::close() !!}
                                        </center>
                                    </div>
                                </div>

                                <div class="col-9 pull-right">
                                    <p>{{$answer->body}}</p>
                                    <a href="/admin/answers/{{$answer->id}}">
                                        <small>
                                            Written on {{$answer->created_at}} by {{$answer->user->name}}
                                        </small>
                                    </a>
                                    <br>
                                    @if ($answer->created_at != $answer->updated_at)
                                        <small style="color:green;">(edited)</small>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        
                        @if ($question->id == $question_id)
                            <div id="add-answer" class="col-12 post-card">
                                <hr>
                                {!! Form::open(['action' => ['AnswersController@store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {{Form::label('body','Answer')}}
                                    {{Form::text('body', '', ['class' => 'form-control'])}}
                                </div>
                                {{ Form::hidden('question_id', $question->id) }}
                                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                                    <a onclick="return confirm('Are you sure you want to cancel?')" href="/admin/questions" class="btn btn-danger pull-right">Cancel</a>
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <ul class="pagination pull-right">{{$questions->links()}}</ul>
        @else
            <p>No question</p>
        @endif
    </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    document.getElementById("nav-four").classList.add("active");
    document.getElementById("text-nav-four").classList.add("color-active");

    $(document).ready(function() {
        var top = $('#add-answer').position().top;
        $('html').scrollTop(top);
    });
</script>
@endsection