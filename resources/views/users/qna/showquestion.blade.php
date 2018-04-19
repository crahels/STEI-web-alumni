@extends('layouts.apphome')

@section('title', 'Questions')

@section('content')
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
            {{-- </div><!-- /.col-md-4 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="feature-2">
                    <div class="media">
                        <div class="pull-left">
                            <i class="fa fa-plug"></i>
                            <div class="border"></div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Wordpress Plugin</h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu</p>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-4 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="feature-2">
                    <div class="media">
                        <div class="pull-left">
                            <i class="fa fa-joomla"></i>
                            <div class="border"></div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Joomla Template</h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu</p>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-4 -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="feature-2">
                    <div class="media">
                        <div class="pull-left">
                            <i class="fa fa-cube"></i>
                            <div class="border"></div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Joomla Extension</h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu</p>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-4 --> --}}
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<div class="container">
    @if(Auth::guard('member')->user() != null || (Auth::user() != null && Auth::user()->IsAdmin == 1))
    <div class="col-lg-12 text-center">
        <button class="btn btn-primary text-center">Add Question</button>
    </div>
    @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    document.getElementById("nav-four").classList.add("active");
    document.getElementById("text-nav-four").classList.add("color-active");

    $("div[id^='answers']").hide();

    $(document).ready(function() {
        $("input[id^='btn']" ).click(function() {
            var element  = this.id;
            classname = element.split("-")[1];

            if ($('#btn-' + classname).hasClass('show-button')) {
                $('#answers-' + classname).hide();

                $('#btn-' + classname).val('Show Answers');
                $('#btn-' + classname).removeClass('show-button');
                $('#btn-' + classname).addClass('hidden-button');

            } else if ($('#btn-' + classname).hasClass('hidden-button')) {
                $('#answers-' + classname).show();
            
                var top = $('#answercontainer-' + classname).position().top;
                $('html').scrollTop(top);

                $('#btn-' + classname).val('Hide Answers');
                $('#btn-' + classname).removeClass('hidden-button');
                $('#btn-' + classname).addClass('show-button');
            }
        });
    });
</script>
@endsection