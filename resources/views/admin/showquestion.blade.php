@extends('layouts.app')

@section('title', 'Questions')

@section('content')

@include('inc.adminmenu') 
    <main role="main" class="col-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">List of Questions</h1>
            <a class="btn btn-primary" href="/admin/questions/create">
                Add Question
            </a>
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
                                <div class="col-2" style="float:left;">
                                    <div class="sum-rating">
                                        <center>
                                            {{$answer->rating}}
                                        </center>
                                    </div>
                                    
                                    @if(Auth::guard('member')->user() != null)
                                        {!! Form::open(['action' => ['AnswersController@giveRating', $answer->id, Auth::guard('member')->user()->id], 'method' => 'POST']) !!}
                                        @if ($answer->users->contains(Auth::guard('member')->user()->id)) 
                                            {{Form::submit('VOTE', ['class' => 'btn'])}}
                                        @else
                                            {{Form::submit('VOTE', ['class' => 'btn btn-warning'])}}
                                        @endif
                                    @else
                                        {!! Form::open(['action' => ['AnswersController@giveRating', $answer->id, Auth::user()->id], 'method' => 'POST']) !!}
                                        {{Form::submit('VOTE', ['class' => 'btn btn-warning'])}}
                                    @endif
                                    
                                    {!! Form::close() !!}
                                </div>

                                <div class="col-10 pull-right">
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
                    </div>
                </div>
            @endforeach
            <ul class="pagination pull-right">{{$questions->links()}}</ul>
        @else
            <p>No question</p>
        @endif
    </main>

<script>
    document.getElementById("nav-four").classList.add("active");
    document.getElementById("text-nav-four").classList.add("color-active");
</script>
@endsection