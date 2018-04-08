@extends('layouts.app')

@section('title', 'Add Member')

@section('content')
    @include('inc.addmembertab')
        <div class="addMemberForm">
            {!! Form::open(['action' => ['AddMemberController@importMember'], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('name','Name')}}
                {{Form::text('name', '', ['class' => 'form-control'])}}
            </div>
            <div class="form-group form-row">
                <div class="col">
                    {{Form::label('nim','Student ID')}}
                    {{Form::text('nim', '', ['class' => 'form-control'])}}
                </div>
                <div class="col">
                    {{Form::label('email','Email')}}
                    {{Form::text('email', '', ['class' => 'form-control'])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('phone_number','Phone Number')}}
                {{Form::text('phone_number', '', ['class' => 'form-control'])}}
            </div>
            {{Form::hidden('_method', 'POST')}}
            <div class="bottomButton">
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                <a onclick="return confirm('Are you sure you want to leave?')" class="btn btn-danger pull-right" href="/members">
                    Cancel
                </a>
            </div>
            {!! Form::close() !!}
        </div>
@endsection