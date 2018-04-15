@extends('layouts.app')

@section('title', $user->name . ' | Update Profile')

@section('content')
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
                        src="/storage/profile_image/{{$user->profile_image}}"
                        class="img-circle img-responsive" id=""> </div>
                        
                            <div class=" col-md-9 col-lg-9 "> 
                                {!! Form::open(['action' => ['MembersController@update',$user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                <div class="form-group">
                                    {{Form::label('profile_image','Profile Image')}}
                                    {{Form::file('profile_image')}}
                                   
                                    <!-- {{Form::label('email','Email')}} 
                                    {{Form::text('email', $user->email , ['class' => 'form-control'])}} -->
 
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
                                <a onclick="return confirm('Are you sure you want to cancel?')" href="/members/{{$user->id}}" class="btn btn-danger pull-right">Cancel</a>
                                 {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <link rel="stylesheet" type="text/css" href="css/file-upload.css" />
<script src="js/file-upload.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.file-upload').file_upload();
    });
</script>

@endsection