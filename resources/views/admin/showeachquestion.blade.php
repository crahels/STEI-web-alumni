@extends('layouts.app')

@section('content')
    <h1>{{$question->topic}}</h1>

    <div class="body-article">
        {!!$question->body!!}
    </div>

    <div class="footer-article">
        <hr>
        <small>Written on {{$question->created_at}} by {{$question->user->name}}</small>
        <hr>
    </div>
    @if(!Auth::guest() &&  Auth::user()->IsAdmin == 1)
    <a href="/admin/questions/{{$question->id}}/edit" class="btn btn-warning">Edit</a>
    {!!Form::open(['action' => ['QuestionsController@destroy', $question->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
    {!!Form::close() !!}
@endif
    <br><br><br>
    <a href="/admin/questions" class="btn btn-info pull-down">&#8592; Back</a>

@endsection