@extends('layouts.app')

@section('title', 'Questions')

@section('content')
<div class="body-qna">
    <main role="main" class="col-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">List of Questions</h1>
            @if(Auth::guard('member')->user() != null || (Auth::user() != null && Auth::user()->IsAdmin == 1))
                <a class="btn btn-primary" href="/admin/questions/create">
                    Add Question
                </a>
            @endif
        </div>
        @if (count($questions) > 0)
            @foreach ($questions as $question)
                <div class="well">
                    <div class="row">
                        <div class="col-12 post-card">
                            <h3><a href="/admin/questions/{{$question->id}}">{{$question->topic}}</a></h3>
                            <p>{{$question->body}}</p>
                            <small>
                                <i>
                                    Written on {{$question->created_at}} by {{$question->user->name}} <span>@if($question->is_admin == 1)<span>as <span style="color:blue;">admin</span></span>@endif</span>
                                </i>
                            </small>
                            <br>
                            @if ($question->created_at != $question->updated_at)
                                <small style="color:green;">(edited)</small>
                            @endif
                            <input type="submit" id="btn-{{$question->id}}" class="hidden-button show-answer btn btn-primary" value="Show Answers"></input>
                        </div>
                    </div>
                    <div id="answers-{{$question->id}}" class="row">
                        @foreach ($question->answers->sortByDesc('rating')->sortByDesc('is_pinned') as $answer)
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
                                                {!! Form::open(['action' => ['AnswersController@givePin', $answer->id, $question->id, 0], 'method' => 'POST']) !!}
                                                @if($answer->is_pinned == 1) 
                                                    {{Form::button('<i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PINNED', ['type' => 'submit', 'class' => 'btn', 'data-toggle' => 'tooltip'])}}
                                                    
                                                @else
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
                        
                        <div id="answercontainer-{{$question->id}}" class="col-12 post-card">
                            <div id="add-answer">
                                <hr>
                                {!! Form::open(['action' => ['AnswersController@store', 0], 'method' => 'POST']) !!}
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
            @endforeach
            <ul class="pagination pull-right">{{$questions->links()}}</ul>
        @else
            <p>No question</p>
        @endif
    </main>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    document.getElementById("nav-four").classList.add("active");
    document.getElementById("text-nav-four").classList.add("color-active");

    $("div[id^='answers']").hide();
    //$("div[id^='answercontainer']").hide();

    $(document).ready(function() {
        $("input[id^='btn']" ).click(function() {
            var element  = this.id;
            classname = element.split("-")[1];

            if ($('#btn-' + classname).hasClass('show-button')) {
                $('#answers-' + classname).hide();

                $('#btn-' + classname).val('Show Answers');
                $('#btn-' + classname).removeClass('show-button');
                $('#btn-' + classname).addClass('hidden-button');

            } else if ($('#btn-' + classname).hasClass('hidden-button')) {
                $('#answers-' + classname).show();
                //$('#answercontainer-' + classname).show();
            
                var top = $('#answercontainer-' + classname).position().top;
                $('html').scrollTop(top);

                $('#btn-' + classname).val('Hide Answers');
                $('#btn-' + classname).removeClass('hidden-button');
                $('#btn-' + classname).addClass('show-button');
            }
        });
    });
</script>
@endsection