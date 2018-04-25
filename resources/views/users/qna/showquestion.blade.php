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
                </div>
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
                <div class="col-8">
                    <div class="well question-container" style="margin-bottom: 0px !important">
                        <div class="row">
                            <div class="col-12 post-card">
                                <h3><a href="/questions/{{$question->id}}" style="word-wrap: break-word;">{{$question->topic}}</a></h3>
                                <p style="font-size: 1.3em; word-wrap: break-word;">{{$question->body}}</p>
                                <small>
                                    <i>
                                        Written on {{$question->created_at->format('d M Y')}} 
                                        @if ($question->is_anon == 1)
                                            by Anonymous
                                        @else
                                            @if ($question->is_admin == 1)
                                                by <a href="/members/{{$question->user->id}}">{{$question->user->name}}</a>
                                            @else
                                                by <a href="/members/{{$question->member->id}}">{{$question->member->name}}</a>
                                            @endif
                                        @endif
                                    </i>
                                </small>
                                @if ($question->created_at != $question->updated_at)
                                    <small style="color:green;">(edited)</small>
                                @endif
                                <!-- <input type="submit" id="btn-{{$question->id}}" class="hidden-button show-answer btn btn-primary" value="Show Answers"></input> -->
                            </div>
                        </div>
                    </div>
                    @if (count($question->answers) > 0)
                    <div id="answers-{{$question->id}}" class="row" style="font-size: 0.8em; background-color: #efefef">
                        @foreach ($question->answers->sortByDesc('rating')->sortByDesc('is_pinned')->take(3) as $answer)
                            <div class="col-12 post-card" style="border: 1px solid #d8d8d8; border-top: 0px !important; padding: 5px 0px">
                                <div class="row">
                                    <div class="col-2" style="max-width: 40px !important; padding: 0px !important; margin-left: 40px">
                                    <span class="sum-rating">{{$answer->rating}}</span>
                                    <small style="font-size:1.1em;">vote<span>@if($answer->rating > 1)<span>s</span>@endif</span></small>
                                </div>
                                <div class="col-10" style="padding: 0px !important; margin-left: 40px">
                                    <span style="word-wrap: break-word;">{{$answer->body}}</span><br>
                                    <a href="/answers/{{$answer->id}}">
                                        <small>
                                            Written on {{$answer->created_at->format('d M Y')}}
                                        </small>
                                    </a>
                                    @if ($answer->is_admin == 1)
                                        by {{$answer->user->name}} as <span style="color:blue;">admin</span>
                                    @else
                                        by <a href="/members/{{$answer->member->id}}">{{$answer->member->name}}</a>
                                    @endif
                                    @if ($answer->created_at != $answer->updated_at)
                                        <small style="color:green;">(edited)</small>
                                    @endif
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    <br>
                </div>
                <div class="col-2"></div>
            @endforeach
            <ul class="pagination pull-right">{{$questions->links()}}</ul>
        @else
        <div class="row">
            <div class="col-2"></div>
            <div class="well question-container col-8 text-center" style="font-size: 1.5em; font-weight: bolder;">
                No Question
            </div>
            <div class="col-2"></div>
        </div>
        @endif
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection