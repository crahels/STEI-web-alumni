@extends('layouts.app')

@section('content')
<div class="row show-question">
    <div class="col-3 left-question">
        <h1 class="title-question">{{$question->topic}}</h1>

        <div>
            {{$question->body}}
        </div>

        <div class="footer-article">
            <hr>
            <small class="text-footer">Written on {{$question->created_at->format('d M Y')}}</small><br>
            <small class="text-footer">Last Editted on {{$question->updated_at->format('d M Y')}}</small><br>
            @if ($question->is_admin == 1)
                <small class="text-footer">by {{$question->user->name}} as <span style="color:red;">admin</span></small>
            @else
                <small class="text-footer">by <a href="/admin/members/{{$question->member_id}}">{{$question->member->name}}</a></small>
            @endif
            @if ($question->is_anon == 1)
                anonymously
            @endif
            <hr>
        </div>
        @if((!Auth::guest() && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && $question->member_id == Auth::guard('member')->user()->id && $question->is_admin == 0))
            <a href="/admin/questions/{{$question->id}}/edit" class="btn btn-warning edit-button">
                Edit
            </a>
            {!!Form::open(['action' => ['QuestionsController@destroy', $question->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger delete-button', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
            {!!Form::close() !!}
        @endif<br><br>
    </div>
    <div class="col-9">
        <h4>Answers:</h4>
        <div class="">
            <div id="answers-{{$question->id}}" class="row">
                @foreach ($question->answers->sortByDesc('rating')->sortByDesc('is_pinned') as $answer)
                    <div class="col-11 post-card">
                        <hr>
                        <div class="col-2 vote-block">
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
                                    {!! Form::open(['action' => ['AnswersController@givePin', $answer->id, $question->id, 1], 'method' => 'POST']) !!}
                                    @if($answer->is_pinned == 1) 
                                        {{Form::button('<div class="btn-pinned"><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PINNED</div>', ['type' => 'submit', 'class' => 'btn', 'data-toggle' => 'tooltip'])}}
                                        
                                    @else
                                        {{Form::button('<div class="btn-pinned"><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PIN</div>', ['type' => 'submit', 'class' => 'btn btn-warning', 'data-toggle' => 'tooltip', 'id' => 'btn-pinned-' . $answer->id])}}
                                    @endif
                                @endif
                                {!! Form::close() !!}
                            </center>
                        </div>

                        <div class="col-9 pull-right">
                            <p>{{$answer->body}}</p>
                            <small class="text-footer">
                                @if ($answer->is_admin == 1)
                                    <a href="/admin/answers/{{$answer->id}}">Written on {{$answer->created_at->format('d M Y')}}</a><br>by {{$answer->user->name}} as <span style="color:red;">admin</span>
                                @else
                                    <a href="/admin/answers/{{$answer->id}}">Written on {{$answer->created_at->format('d M Y')}}</a><br>by <a href="/admin/members/{{$answer->member_id}}">{{$answer->member->name}}</a>
                                @endif
                            </small>
                            <br>
                            @if ($answer->created_at != $answer->updated_at)
                                <small style="color:green;" class="text-footer">(edited)</small>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                <div id="answercontainer-{{$question->id}}" class="col-11 post-card">
                    <div id="add-answer">
                        <hr>
                        <form id="answer-{{$question->id}}" action="#">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group answer-box">
                                <label for="body">Answer</label>
                                <input type="text" class="form-control" id="bodyanswer-{{$question->id}}" name="body"><br>
                                <input id="submitanswer-{{$question->id}}" type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
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
                url: "{{ url('admin/answer/store_ajax') }}",
                type: "POST",
                data: {
                    body: body_ans,
                    question_id: question_id_ans
                },
                success: function(data) {
                    console.log(data.question_id);
                    $('#bodyanswer-' + question_id_ans).val('');
                    $(
                        '<div class="col-11 post-card" name="answer-added">' +
                            '<hr>' +
                            '<div class="col-2 vote-block">' +
                                '<center>' +
                                    '<small class="text-vote">vote' + 
                                    '</small><br>' + 
                                    '<span class="sum-rating">' +
                                        '0' + 
                                    '</span>' +
                                    '<form method="POST" action="/admin/answers/pin/' + data.id + '/' + data.question_id + '/1">' +
                                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                                    '{{Form::button("<div class=\"btn-pinned\" <i class=\"fa fa-thumb-tack\"></i>&nbsp;&nbsp;PIN</div>", ["type" => "submit", "class" => "btn btn-warning", "data-toggle" => "tooltip"])}}' +
                                    '</form>' +
                                '</center>' +
                            '</div>' +

                            '<div class="col-9 pull-right">' +
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
                    $('<div class="alert alert-danger">Fail To Save</div>').insertAfter(".top-of-page");
                    var top = $('.top-of-page').position().top;
                    $('html').scrollTop(top);
                }
            });
        });
    });
</script>
@endsection