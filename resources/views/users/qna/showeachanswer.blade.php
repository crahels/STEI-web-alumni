@extends('layouts.app')

@section('content')
<div class="row create-post-container">
    <div class="col-3 header-create-post">
        <h1>Show <br>Answer</h1>
    </div>
    <div class="col-8 post">
        <div class=" col-md-12 col-lg-12">
            @if($answer->is_pinned == 1)
                <button data-toggle="tooltip" class="btn pull-right"><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;PINNED</button> 
            @else
                <button data-toggle="tooltip" class="btn btn pull-right"><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;NOT PINNED</button>
            @endif
            <br>
            <br>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Topic</td>
                        <td>:&nbsp;{{$answer->question->topic}}</td>
                    </tr>
                        <td>Question's Body</td>
                        <td>:&nbsp;{{$answer->question->body}}</td>                            
                    </tr>
                    <tr>
                        <td>Answer's Body</td>
                        <td>:&nbsp;{{$answer->body}}</td>
                    </tr>
                    <tr>
                        <td>Votes</td>
                        <td>:&nbsp;{{$answer->rating}}</td>
                    </tr>
                    <tr>
                        <td>Written On</td>
                        <td>:&nbsp;{{$answer->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Last Editted On</td>
                        <td>:&nbsp;{{$answer->updated_at}}</td>
                    </tr>
                    <tr>
                        <td>Written By</td>
                        <td>:&nbsp;{{$answer->user->name}}<span>@if($answer->is_admin == 1) <span>as <span style="color:blue;">admin</span></span>@endif</span></td>
                    </tr>
                <tbody>
            </table>
        </div>
        <!--<div class="body-article" style="font-size:1.5em;">Answer of Question "{{$answer->question->topic}}: {{$answer->question->body}}"</div>

        <div class="body-article" style="font-size:1.5em;">
            {{$answer->body}}
        </div>-->
    
        <!--<div class="footer-article">
            <hr>
            <small>Written on {{$answer->created_at}}</small><br>
            <small>Last Editted on {{$answer->updated_at}}</small><br>
            <small>by {{$answer->user->name}}<span>@if($answer->is_admin == 1) <span>as <span style="color:blue;">admin</span></span>@endif</span></small>
            <hr>
        </div>-->
        @if((!Auth::guest() && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && $answer->user->id == Auth::guard('member')->user()->id && $answer->is_admin == 0))
            <a href="/answers/{{$answer->id}}/edit" class="btn btn-warning">
                Edit
            </a>
            {!!Form::open(['action' => ['AnswersController@destroy', $answer->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
            {!!Form::close() !!}
        @endif
        <!--<br><br><br>
        <a href="/admin/questions" class="btn btn-info pull-down">&#8592; Back</a>-->
    </div>
</div>
@endsection