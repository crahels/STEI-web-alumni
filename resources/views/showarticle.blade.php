@extends('layouts.apphome')

@section('title', 'Posts')

@section('content')
<div class="body-qna">
    <div class="qna-container">
      <div class="row">
        <div class="col-2"></div>
          <div class="well question-container col-8" style="margin-top: 50px; min-width: 1000px">
            <h1>{{$post->title}}</h1>
            @if ($post->draft == '1')
              <span style="color:red;">Draft</span>
            @else
              <span style="color:green;">Published</span>
            @endif
            <h5>
                @if ($post->public == '1')
                    Public 
                @else
                    Private 
                @endif  
                Post
            </h5>
            <hr>
            <div style="word-wrap: break-word;">{!!$post->body!!}</div>
            <!-- FOOTER -->
            <div class="footer-article">
            <hr>
            <small>Written on {{$post->created_at->format('d M Y')}}</small><br>
            <small>Last Editted on {{$post->updated_at->format('d M Y')}}</small><br>
            <small>by Admin</small>
            <hr>

            @if(!Auth::guest() &&  Auth::user()->IsAdmin == 1)
                <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
                {!!Form::close() !!}
            @endif
            <a href="/posts" class="btn btn-info pull-down">&#8592; Back</a>
            </div>
          </div> <!--END OF WELL-->
        <div class="col-2"></div>
      </div>
    </div>
</div>
@endsection