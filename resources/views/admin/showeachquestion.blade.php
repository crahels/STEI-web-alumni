@extends('layouts.app')

@section('content')
    <h1>{{$question->topic}}</h1>

    <div class="body-article">
        {!!$question->body!!}
    </div>

    <div class="footer-article">
        <hr>
        <small>Written on {{$question->created_at}}</small>
        <hr>
    </div>
    <br><br><br>
    <a href="/questions" class="btn btn-info pull-down">&#8592; Back</a>

@endsection