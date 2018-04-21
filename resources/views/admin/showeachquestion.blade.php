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
            <small>Written on {{$question->created_at->format('d M Y')}}</small><br>
            <small>Last Editted on {{$question->updated_at->format('d M Y')}}</small><br>
            @if ($question->is_admin == 1)
                <small>by {{$question->user->name}} as <span style="color:lightblue;">admin</span></small>
            @else
                <small>by {{$question->member->name}}</small>
            @endif
            <hr>
        </div>
        @if((!Auth::guest() && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && $question->member->id == Auth::guard('member')->user()->id && $question->is_admin == 0))
            <a href="/admin/questions/{{$question->id}}/edit" class="btn btn-warning">
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
                            <p>{{$answer->body}}</p>
                            <a href="/admin/answers/{{$answer->id}}">
                                <small>
                                    @if ($answer->is_admin == 1)
                                        Written on {{$answer->created_at->format('d M Y')}} by {{$answer->user->name}} as <span style="color:blue;">admin</span>
                                    @else
                                        Written on {{$answer->created_at->format('d M Y')}} by {{$answer->member->name}}
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
                
                <div id="answercontainer-{{$question->id}}" class="col-9 post-card">
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
    <!--<br><br><br>
    <a href="/admin/questions" class="btn btn-info pull-down">&#8592; Back</a>-->
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
                    console.log(data);
                    $('#bodyanswer-' + question_id_ans).val('');
                    $(
                        '<div class="col-9 post-card">' +
                            '<hr>' +
                            '<div class="col-3" style="float:left;">' +
                                '<div>' +
                                    '<center>' +
                                        '<small style="font-size:1.1em;">vote' + 
                                        '</small><br>' + 
                                        '<span class="sum-rating">' +
                                            '0' + 
                                        '</span>' +
                                        '<form method="POST" action="/admin/answers/pin/' + data.id + '/' + data.question_id + '/1">' +
                                        '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                                        '{{Form::button("<i class=\"fa fa-thumb-tack\"></i>&nbsp;&nbsp;PIN", ["type" => "submit", "class" => "btn btn-warning", "data-toggle" => "tooltip"])}}' +
                                        '</form>' +
                                    '</center>' +
                                '</div>' +
                            '</div>' +

                            '<div class="col-12">' +
                                '<p>' + data.body + '</p>' +
                                '<a href="/admin/answers/' + data.id + '">' + 
                                    '<small>' +
                                        'Written on ' + data.created + ' by ' + data.user.name + ' as <span style="color:blue;">admin</span>' + 
                                    '</small>' +
                                '</a>' +
                                '<br>' +
                            '</div>' +
                        '</div>'
                    ).insertBefore("#answercontainer-" + question_id_ans);
                },
                error: function(data) {
                }
            });
        });
    });
</script>
@endsection