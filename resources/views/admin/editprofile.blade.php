@extends('layouts.app')

@section('title', $user->name . ' | Edit Profile')

@section('content')
<div class="row edit-profile">
  <div class="col-4 edit-prof-pic">
    <img alt="User Pic" src="/storage/profile_image/{{$user->profile_image}}" class="img-circle img-responsive"
    id="user-ava">
    <h3 class="panel-title user-main-name">{{$user->name}}</h3>
    <h3 class="panel-title nim">{{$user->nim}}</h3>
  </div>
  <div class="col-8">
    <div class="profile-content">
      <h1 id="profile-header"> EDIT PROFILE </h1>
      <div class="profile-info">
        <div class="col-md-9 col-lg-9"> 
            {!! Form::open(['action' => ['MembersController@update',$user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <table class="table table-user-information">
                <tbody>
                    <tr>
                        <td>Profile Image</td>
                        <td>{{Form::file('profile_image')}}</td>                         
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>{{Form::text('phone_number', $user->phone_number, ['class' => 'form-control'])}}</td>
                    </tr>
                    <tr>
                        <td>Company</td>
                        <td>{{Form::text('company', $user->company, ['class' => 'form-control'])}}</td>
                    </tr>
                    <tr>
                        <td>Interest</td>
                        <td>{{Form::text('interest', $user->interest, ['class' => 'form-control'])}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{Form::text('address', $user->address, ['class' => 'form-control'])}}</td>
                    </tr>                   
                </tbody>
            </table>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            <a onclick="return confirm('Are you sure you want to cancel?')" href="/admin/members/{{$user->id}}" style="color:white;" class="btn btn-danger pull-right">Cancel</a>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
@endsection
<link rel="stylesheet" type="text/css" href="css/file-upload.css" />
<script src="js/file-upload.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.file-upload').file_upload();
    });
</script>