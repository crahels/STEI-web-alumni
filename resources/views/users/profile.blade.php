@extends('layouts.app')

@section('title', $user->name . ' | Profile')

@section('content')
<div class="row edit-profile">
  <div class="col-4 edit-prof-pic">
    <img alt="User Pic" src="/storage/profile_image/{{$user->profile_image}}" class="img-circle img-responsive"
    id="user-ava">
    <h3 class="panel-title user-main-name">{{$user->name}}</h3>
  </div>
  <div class="col-8">
    <div class="profile-content">
      <h1 id="profile-header"> MY PROFILE </h1>
      <div class="profile-info">
          
      </div>
    </div>
  </div>
</div>
@endsection