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
        <div class="section text-center">
            <a id="add-question-btn" class="btn btn-primary" href="questions/create">Add Question</a>
        </div>
        @endif
        @if (count($questions) > 0)
            <div class="row">
                @foreach ($questions as $question)
                <div class="col-2"></div>
                <div class="well question-container col-8">
                    <div class="row">
                        <div class="col-12 post-card">
                            <h3><a href="/questions/{{$question->id}}">{{$question->topic}}</a></h3>
                            <p style="font-size: 1.3em">{{$question->body}}</p>
                            <small>
                                <i>
                                    Written on {{$question->created_at}} by {{$question->member->name}}
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
                            <div class="col-12 post-card">
                                <hr>
                                    <p>{{$answer->body}}</p>
                                    <a href="/answers/{{$answer->id}}">
                                        <small>
                                            Written on {{$answer->created_at}} by {{$answer->member->name}} <span>@if($answer->is_admin == 1)<span>as <span style="color:blue;">admin</span></span>@endif</span>
                                        </small>
                                    </a>
                                    <br>
                                    @if ($answer->created_at != $answer->updated_at)
                                        <small style="color:green;">(edited)</small>
                                    @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-2"></div>
            @endforeach
            <ul class="pagination pull-right">{{$questions->links()}}</ul>
        @else
            <span> No question </span>
        @endif
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection