@extends('layouts.app')

@section('title', 'Questions')

@section('content')

@include('inc.adminmenu') 
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
                                    @if ($question->is_admin == 1)
                                        Written on {{$question->created_at}} by {{$question->user->name}} as <span style="color:blue;">admin</span>
                                    @else
                                        Written on {{$question->created_at}} by {{$question->member->name}}
                                    @endif
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
                                                @if ($answer->members->contains(Auth::guard('member')->user()->id)) 
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
                                            @if ($answer->is_admin == 1) 
                                                Written on {{$answer->created_at}} by {{$answer->user->name}} as <span style="color:blue;">admin</span>
                                            @else
                                                Written on {{$answer->created_at}} by {{$answer->member->name}}
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
                                <!--<form id="answer-{{$question->id}}" action="#">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="body">Answer</label>
                                        <input type="text" class="form-control" id="bodyanswer-{{$question->id}}" name="body">
                                    </div>
                                    <input id="submitanswer-{{$question->id}}" type="submit" class="btn btn-primary pull-right" value="Submit">
                                </form>-->
                                
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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    document.getElementById("nav-four").classList.add("active");
    document.getElementById("text-nav-four").classList.add("color-active");

    $("div[id^='answers']").hide();
    //$("div[id^='answercontainer']").hide();

    $(document).ready(function() {
        $("input[id^='btn']" ).click(function() {
            var element  = this.id;
            var question_id = element.split("-")[1];

            if ($('#btn-' + question_id).hasClass('show-button')) {
                $('#answers-' + question_id).hide();

                $('#btn-' + question_id).val('Show Answers');
                $('#btn-' + question_id).removeClass('show-button');
                $('#btn-' + question_id).addClass('hidden-button');

            } else if ($('#btn-' + question_id).hasClass('hidden-button')) {
                $('#answers-' + question_id).show();
                //$('#answercontainer-' + classname).show();
            
                var top = $('#answercontainer-' + question_id).position().top;
                $('html').scrollTop(top);

                $('#btn-' + question_id).val('Hide Answers');
                $('#btn-' + question_id).removeClass('hidden-button');
                $('#btn-' + question_id).addClass('show-button');
            }
        });

        /*$("input[id^='submitanswer']" ).click(function() {
            var element  = this.id;
            var question_id = element.split("-")[1];
            var body = $('#bodyanswer-' + question_id).val();
        });*/

        /*$("form[id^='answer']").submit(function(e) {
            e.preventDefault();

            var element  = this.id;
            var question_id_ans = element.split("-")[1];
            var body_ans = $('#bodyanswer-' + question_id_ans).val();
            
            var dataString = "question_id=" + question_id_ans + "&body=" + body_ans;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                url: "answers/store_ajax",
                type: "POST",
                data: {
                    body: body_ans,
                    question_id: question_id_ans
                },
                success: function(data) {
                    console.log(data);
                    console.log("berhasil");
                },
                error: function(data) {
                    console.log(data);
                    console.log("gagal");
                }
            });
        });*/
    });
</script>
@endsection