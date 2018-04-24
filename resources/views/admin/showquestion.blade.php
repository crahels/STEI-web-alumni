@extends('layouts.app')

@section('title', 'Questions')

@section('content')

@include('inc.adminmenu') 
    <main role="main" class="col-8">
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
                <div class="well col-12">
                    <div class="row">
                        <div class="col-12 post-card">
                            <h3 class="title-question">{{$question->topic}}</h3>
                            <p>{{$question->body}}</p>
                            <small class="text-footer">
                                <i>
                                    @if ($question->is_admin == 1)
                                        <a href="questions/{{$question->id}}">Written on {{$question->created_at->format('d M Y')}}</a><br>by {{$question->user->name}} as <span style="color:red;">admin</span>
                                    @else
                                        <a href="questions/{{$question->id}}">Written on {{$question->created_at->format('d M Y')}}</a><br>by <a href="members/{{$question->member_id}}">{{$question->member->name}}</a>
                                    @endif
                                    @if ($question->is_anon == 1)
                                        anonymously
                                    @endif
                                </i>
                            </small>
                            <br>
                            @if ($question->created_at != $question->updated_at)
                                <small style="color:green;" class="text-footer">(edited)</small>
                            @endif
                            <input type="submit" id="btn-{{$question->id}}" class="hidden-button pull-right btn btn-primary" value="Show Answers">
                        </div>
                    </div>
                    <div id="answers-{{$question->id}}" class="row">
                        @foreach ($question->answers->sortByDesc('rating')->sortByDesc('is_pinned') as $answer)
                            <div class="col-12 post-card">
                                <hr>
                                <div class="col-4 vote-block">
                                    <center>
                                        <small class="text-vote">vote<span>@if($answer->rating > 1)<span>s</span>@endif</span>
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
                                                {{Form::button('<div class="btn-pinned"><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PINNED</div>', ['type' => 'submit', 'class' => 'btn', 'data-toggle' => 'tooltip'])}}
                                                
                                            @else
                                                {{Form::button('<div class="btn-pinned"><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PIN</div>', ['type' => 'submit', 'class' => 'btn btn-warning', 'data-toggle' => 'tooltip'])}}
                                            @endif
                                        @endif
                                        {!! Form::close() !!}
                                    </center>
                                </div>
        
                                <div class="col-8 pull-right">
                                    <p>{{$answer->body}}</p>
                                        <small class="text-footer">
                                            @if ($answer->is_admin == 1) 
                                                <a href="answers/{{$answer->id}}">Written on {{$answer->created_at->format('d M Y')}}</a><br>by {{$answer->user->name}} as <span style="color:red;">admin</span>
                                            @else
                                                <a href="answers/{{$answer->id}}">Written on {{$answer->created_at->format('d M Y')}}</a><br>by <a href="members/{{$answer->member_id}}">{{$answer->member->name}}</a>
                                            @endif
                                        </small>
                                    <br>
                                    @if ($answer->created_at != $answer->updated_at)
                                        <small style="color:green;" class="text-footer">(edited)</small>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div id="answercontainer-{{$question->id}}" class="col-12 post-card">
                            <div id="add-answer">
                                <hr>
                                <form id="answer-{{$question->id}}" action="#">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="body">Answer</label>
                                        <input type="text" class="form-control" id="bodyanswer-{{$question->id}}" name="body"><br>
                                        <input id="submitanswer-{{$question->id}}" type="submit" class="btn btn-primary pull-right" value="Submit">
                                    </div>
                                </form>
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

        $("form[id^='answer']").submit(function(e) {
            e.preventDefault();

            var element  = this.id;
            var question_id_ans = element.split("-")[1];
            var body_ans = $('#bodyanswer-' + question_id_ans).val();
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                url: "answer/store_ajax",
                type: "POST",
                data: {
                    body: body_ans,
                    question_id: question_id_ans
                },
                success: function(data) {
                    $('#bodyanswer-' + question_id_ans).val('');
                    $(
                        '<div class="col-12 post-card">' +
                            '<hr>' +
                            '<div class="col-4 vote-block">' +
                                '<div>' +
                                    '<center>' +
                                        '<small class="text-vote">vote' + 
                                        '</small><br>' + 
                                        '<span class="sum-rating">' +
                                            '0' + 
                                        '</span>' +
                                        '<form method="POST" action="/admin/answers/pin/' + data.id + '/' + data.question_id + '/0">' +
                                        '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                                        '{{Form::button("<div class=\"btn-pinned\"><i class=\"fa fa-thumb-tack\"></i>&nbsp;&nbsp;PIN</div>", ["type" => "submit", "class" => "btn btn-warning", "data-toggle" => "tooltip"])}}' +
                                        '</form>' +
                                    '</center>' +
                                '</div>' +
                            '</div>' +

                            '<div class="col-8 pull-right">' +
                                '<p>' + data.body + '</p>' +
                                    '<small class="text-footer">' +
                                        '<a href="/admin/answers/' + data.id + '">Written on ' + data.created + '</a><br>by ' + data.user.name + ' as <span style="color:red;">admin</span>' + 
                                    '</small>' +
                                '<br>' +
                            '</div>' +
                        '</div>'
                    ).insertBefore("#answercontainer-" + question_id_ans);
                },
                error: function(data) {
                    console.log(data);
                    $('<div class="alert alert-danger">Fail To Save</div>').insertAfter(".top-of-page");
                    var top = $('.top-of-page').position().top;
                    $('html').scrollTop(top);
                }
            });
        });
    });
</script>
@endsection