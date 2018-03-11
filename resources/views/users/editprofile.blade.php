@extends('layouts.app')

@section('title', $user->name . ' | Update Profile')

@section('content')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <h2 class="sub-title">Edit Profile</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >  
            <div class="panel panel-info">
                <div class="panel-heading">
                <h3 class="panel-title">{{$user->name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" 
                        src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" 
                        class="img-circle img-responsive" id=""> </div>
                        
                            <div class=" col-md-9 col-lg-9 "> 
                                {!! Form::open(['action' => ['UsersController@update',$user->id], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {{Form::label('email','Email')}}
                                    {{Form::text('email', $user->email , ['class' => 'form-control'])}}

                                    {{Form::label('phone_number','Phone Number')}}
                                    {{Form::text('phone_number', $user->phone_number, ['class' => 'form-control'])}}

                                    {{Form::label('company','Company')}}
                                    {{Form::text('company', $user->company, ['class' => 'form-control'])}}
                                    
                                    {{Form::label('interest','Interest')}}
                                    {{Form::text('interest', $user->interest, ['class' => 'form-control'])}}

                                    {{Form::label('address','Address')}}
                                    {{Form::text('address', $user->address, ['class' => 'form-control'])}}
                                </div>
                                {{Form::hidden('_method', 'PUT')}}
                                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                                 {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

@endsection