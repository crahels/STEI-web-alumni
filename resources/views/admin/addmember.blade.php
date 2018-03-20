@extends('layouts.app')

@section('title', 'Add Member')

@section('content')
    @include('inc.adminmenu')
    <main role="main" class="col-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h2 class="sub-title">Add Members</h2>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            {!! Form::open(['action' => ['AddMemberController@importCSV'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('list_members','Members')}}
                {{Form::file('list_members')}}
            </div>
            {{Form::hidden('_method', 'POST')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </main>

    <main role="main" class="col-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h2 class="sub-title">Add Members</h2>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            {!! Form::open(['action' => ['AddMemberController@importMember'], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('nim','Student ID')}}
                {{Form::text('nim', '', ['class' => 'form-control'])}}

                {{Form::label('email','Email')}}
                {{Form::text('email', '', ['class' => 'form-control'])}}

                {{Form::label('phone_number','Phone Number')}}
                {{Form::text('phone_number', '', ['class' => 'form-control'])}}

                {{Form::label('name','Name')}}
                {{Form::text('name', '', ['class' => 'form-control'])}}
            </div>
            {{Form::hidden('_method', 'POST')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </main>

    <link rel="stylesheet" type="text/css" href={{asset('css/file-upload.css')}} />
    <script src="js/file-upload.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.file-upload').file_upload();
        });
    </script>
@endsection