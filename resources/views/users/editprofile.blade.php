@extends('layouts.app')

@section('title', $user->name . ' | Update Profile')

@section('content')
    <h1>Edit Profile</h1>
    {!! Form::open(['action' => ['UsersController@update',$user->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('email','Email')}}
            {{Form::text('email', $user->email , ['class' => 'form-control'])}}

            {{Form::label('phone_number','Nomor HP')}}
            {{Form::text('phone_number', $user->phone_number, ['class' => 'form-control'])}}

            {{Form::label('company','Perusahaan')}}
            {{Form::text('company', $user->company, ['class' => 'form-control'])}}
            
            {{Form::label('interest','Interest')}}
            {{Form::text('interest', $user->interest, ['class' => 'form-control'])}}

            {{Form::label('address','Alamat')}}
            {{Form::text('address', $user->address, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection