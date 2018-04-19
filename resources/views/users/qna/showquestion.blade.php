@extends('layouts.apphome')

@section('title', 'Questions')

@section('content')
<div class="body-qna">
    <section class="services-section qna-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3>Welcome to Alumni STEI Forum</h3>
                        <p>Question & Answer</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-2">
                        <div class="media">
                            <div class="pull-left">
                                <i class="fa fa-question-circle"></i>
                                <div class="border"></div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Ask Anything!</h4>
                                <p>Have something in your mind? <br> Ask them here right away!</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col-md-4 -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-2">
                        <div class="media">
                            <div class="pull-left">
                                <i class="fa fa-quote-left"></i>
                                <div class="border"></div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Post Your Answer</h4>
                                <p>Know about something? Say it in the answer</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col-md-4 -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-2">
                        <div class="media">
                            <div class="pull-left">
                                <i class="fa fa-comments"></i>
                                <div class="border"></div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Interact with others</h4>
                                <p>Exchange your opinions on this forum!</p>
                            </div>
                        </div>
                    </div>
                {{-- </div><!-- /.col-md-4 -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-2">
                        <div class="media">
                            <div class="pull-left">
                                <i class="fa fa-plug"></i>
                                <div class="border"></div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Wordpress Plugin</h4>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col-md-4 -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-2">
                        <div class="media">
                            <div class="pull-left">
                                <i class="fa fa-joomla"></i>
                                <div class="border"></div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Joomla Template</h4>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col-md-4 -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-2">
                        <div class="media">
                            <div class="pull-left">
                                <i class="fa fa-cube"></i>
                                <div class="border"></div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Joomla Extension</h4>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col-md-4 --> --}}
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>

    <div class="container qna-container">
        @if(Auth::guard('member')->user() != null || (Auth::user() != null && Auth::user()->IsAdmin == 1))
        <div class="col-lg-12 text-center">
            <a id="add-question-btn" class="btn btn-primary" href="questions/create">Add Question</a>
        </div>
        @endif

        @if (count($questions) > 0)
            @foreach ($questions as $question)
            <div class="row">
                <div class="col-2"></div>
                <div class="well question-container col-8">
                    <div class="row">
                        <div class="col-12 post-card">
                            <h3><a href="/questions/{{$question->id}}">{{$question->topic}}</a></h3>
                            <p>{{$question->body}}</p>
                            <small>
                                <i>
                                    Written on {{$question->created_at}} by {{$question->name}}
                                </i>
                            </small>
                            <br>
                            @if ($question->created_at != $question->updated_at)
                                <small style="color:green;">(edited)</small>
                            @endif
                            <!-- <input type="submit" id="btn-{{$question->id}}" class="hidden-button show-answer btn btn-primary" value="Show Answers"></input> -->
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
                <div class="col-2"></div>
            </div>
            @endforeach
            <ul class="pagination pull-right">{{$questions->links()}}</ul>
        @else
            <span> No question </span>
        @endif
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script>
    document.getElementById("nav-four").classList.add("active");
    document.getElementById("text-nav-four").classList.add("color-active");

    $("div[id^='answers']").hide();

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
            
                var top = $('#answercontainer-' + classname).position().top;
                $('html').scrollTop(top);

                $('#btn-' + classname).val('Hide Answers');
                $('#btn-' + classname).removeClass('hidden-button');
                $('#btn-' + classname).addClass('show-button');
            }
        });
    });
</script> -->
@endsection