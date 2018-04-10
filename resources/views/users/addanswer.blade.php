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
                            <h3><a href="/questions/{{$question->id}}">{{$question->topic}}</a></h3>
                            <p>{{$question->body}}</p>
                            <small><i>Written on {{$question->created_at}} by {{$question->user->name}}</i></small><br>
                            <a href="/answers/add/{{$question->id}}" class="btn btn-primary" style="float:right;">
                                Give Answer
                            </a>
                        </div>

                        @foreach ($question->answers as $answer)
                            <div class="col-12 post-card">
                                <hr>
                                <p>{{$answer->body}}</p>
                                <small>Written on {{$answer->created_at}} by {{$answer->user->name}}</small><br>
                                @if ($answer->created_at != $answer->updated_at)
                                    <small style="color:green;">(edited)</small>
                                @endif
                            </div>
                        @endforeach
                        
                        @if ($question->id == $question_id)
                            <div class="col-12 post-card">
                                <hr>
                                {!! Form::open(['action' => ['AnswersController@store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {{Form::label('body','Answer')}}
                                    {{Form::text('body', '', ['class' => 'form-control'])}}
                                </div>
                                {{ Form::hidden('question_id', $question->id) }}
                                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                                    <a onclick="return confirm('Are you sure you want to cancel?')" href="/questions" class="btn btn-danger pull-right">Cancel</a>
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

<script>
    document.getElementById("nav-four").classList.add("active");
    document.getElementById("text-nav-four").classList.add("color-active");
</script>
@endsection