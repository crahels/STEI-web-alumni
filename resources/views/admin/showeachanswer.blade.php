@extends('layouts.app')

@section('content')
    <h1>Q: {!!$answer->question->body!!}</h1>

    <div class="body-article">
        {{$answer->body}}
    </div>

    <div class="footer-article">
        <hr>
        <small>Written on {{$answer->created_at}} by {{$answer->user->name}}</small>
        <hr>
    </div>
    @if((!Auth::guest() && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && $answer->user()->id == Auth::guard('member')->user()->id && $answer->is_admin == 0))
        <a href="/admin/answers/{{$answer->id}}/edit" class="btn btn-warning">
            Edit
        </a>
        {!!Form::open(['action' => ['AnswersController@destroy', $answer->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
        {!!Form::close() !!}
    @endif
    <br><br><br>
    <a href="/admin/questions" class="btn btn-info pull-down">&#8592; Back</a>

@endsection