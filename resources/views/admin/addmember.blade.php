<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container">
                <h2 class="sub-title">Add Members</h2>
                {!! Form::open(['action' => ['AddMemberController@importCSV'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('list_members','Members')}}
                    {{Form::file('list_members')}}
                </div>
                {{Form::hidden('_method', 'POST')}}
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}   
                <link rel="stylesheet" type="text/css" href="css/file-upload.css" />
            <script src="js/file-upload.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.file-upload').file_upload();
                });
            </script>
        </div>
        <div class="container">
                <h2 class="sub-title">Add Members</h2>
                {!! Form::open(['action' => ['AddMemberController@importMember'], 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('email','Email')}}
                    {{Form::text('email', '', ['class' => 'form-control'])}}

                    {{Form::label('phone_number','Phone Number')}}
                    {{Form::text('phone_number', '', ['class' => 'form-control'])}}

                    {{Form::label('name','name')}}
                    {{Form::text('name', '', ['class' => 'form-control'])}}
                </div>
                {{Form::hidden('_method', 'POST')}}
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
        </div>
    </body>
</html>