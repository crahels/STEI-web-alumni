@extends('layouts.apphome')

@section('title', 'Posts')

@section('content')
<div class="body-qna">
    <section class="services-section qna-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3>Welcome to Alumni STEI Article</h3>
                        <p>Get most updated news about Alumni STEI here</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-2">
                        <div class="media">
                            <div class="pull-left">
                                <i class="fa fa-book"></i>
                                <div class="border"></div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Read Article</h4>
                                <p>Read all the articles!</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col-md-4 -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-2">
                        <div class="media">
                            <div class="pull-left">
                                <i class="fa fa-group"></i>
                                <div class="border"></div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Interact</h4>
                                <p>Interact with the articles</p>
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
                                <h4 class="media-heading">Share and Go</h4>
                                <p>Enjoy your time reading all the articles and spread loves</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>

    <div class="container qna-container">
        @if (count($posts) > 0)
            <div class="row">
                @foreach ($posts as $post)
                <div class="col-2"></div>
                <div class="well question-container col-8">
                    <div class="row">
                        <div class="col-8 post-card">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <div style="word-wrap: break-word;"> {!!substr($post->body, 0, 200)!!}... </div>
                            <small style="font-weight: bolder;">Written on {{$post->created_at->format('d M Y')}} by <span style="color: red">Admin</span></small>
                        </div>
                        <div class="col-4 img-card">
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            @endforeach
            <ul class="pagination pull-right">{{$posts->links()}}</ul>
        @else
          <div class="row">
              <div class="col-2"></div>
              <div class="well question-container col-8 text-center" style="font-size: 1.5em; font-weight: bolder;">
                  No Post
              </div>
              <div class="col-2"></div>
          </div>
        @endif
      </div>
  </div>

<script>
    document.getElementById("nav-three").classList.add("active");
    document.getElementById("text-nav-three").classList.add("color-active");
    feather.replace();
</script>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
@endsection