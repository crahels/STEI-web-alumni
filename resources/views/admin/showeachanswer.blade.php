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
                        <td style="word-wrap: break-word;">:&nbsp;{{$answer->question->topic}}</td>
                    </tr>
                        <td>Question's Body</td>
                        <td style="word-wrap: break-word;">:&nbsp;{{$answer->question->body}}</td>                            
                    </tr>
                    <tr>
                        <td>Answer's Body</td>
                        <td style="word-wrap: break-word;">:&nbsp;{{$answer->body}}</td>
                    </tr>
                    <tr>
                        <td>Votes</td>
                        <td>:&nbsp;{{$answer->rating}}</td>
                    </tr>
                    <tr>
                        <td>Written On</td>
                        <td>:&nbsp;{{$answer->created_at->format('d M Y')}}</td>
                    </tr>
                    <tr>
                        <td>Last Editted On</td>
                        <td>:&nbsp;{{$answer->updated_at->format('d M Y')}}</td>
                    </tr>
                    <tr>
                        <td>Written By</td>
                        @if ($answer->is_admin == 1)
                            <td>:&nbsp;{{$answer->user->name}} as <span style="color:blue;">admin</span></td>
                        @else
                            <td>:&nbsp;{{$answer->member->name}}</td>
                        @endif
                    </tr>
                <tbody>
            </table>
        </div>
        @if((!Auth::guest() && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && $answer->member->id == Auth::guard('member')->user()->id && $answer->is_admin == 0))
            <a href="/admin/answers/{{$answer->id}}/edit" class="btn btn-warning">
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