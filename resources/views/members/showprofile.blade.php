@extends('layouts.apphome')

@section('title', $user->name . ' | Profile')

@section('content')
<div class="container">
    <div class="row edit-profile">
    <div class="col-4 edit-prof-pic">
        <img alt="User Pic" src="/storage/profile_image/{{$user->profile_image}}" class="img-circle img-responsive"
        id="user-ava">
        <h3 class="panel-title user-main-name">{{$user->name}}</h3>
        <h3 class="panel-title nim">{{$user->nim}}</h3>
    </div>
    <div class="col-8">
        <div class="profile-content">
        <h1 id="profile-header"> MY PROFILE </h1>
        <div class="profile-info">
            <div class=" col-md-9 col-lg-9 "> 
                <table class="table table-user-information">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                        </tr>
                            <td>Phone Number</td>
                            <td>{{$user->phone_number}}                            
                        </tr>
                        <tr>
                            <td>Company</td>
                            <td>{{$user->company}}</td>
                        </tr>
                        <tr>
                            <td>Interest</td>
                            <td>{{$user->interest}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$user->address}}</td>
                        </tr>
                        @if(Auth::guard('member')->user() != null && Auth::guard('member')->user()->id == $user->id)
                            @if(Auth::guard('member')->user()->facebook_email != null)
                                <tr>
                                    <td>
                                        Facebook Account
                                    </td>
                                    <td>
                                        <a href="/link/facebook/delete" data-original-title="Delete Facebook Link" 
                                            data-toggle="tooltip" type="button" class="btn btn-sm btn-danger">
                                            {{Auth::guard('member')->user()->facebook_email}} <i class="glyphicon glyphicon-remove"></i> 
                                        </a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        Facebook Account
                                    </td>
                                    <td>
                                        <a href="/link/facebook" data-toggle="tooltip" type="button" class="btn btn-sm btn-success">
                                            Link facebook account
                                        </a>
                                    </td>
                                </tr>
                            @endif
                            @if(Auth::guard('member')->user()->linkedin_email != null)
                                <tr>
                                    <td>
                                        Linkedin Account
                                    </td>
                                    <td>
                                        <a href="/link/linkedin/delete" data-original-title="Delete Linkedin Link" 
                                            data-toggle="tooltip" type="button" class="btn btn-sm btn-danger">
                                            {{Auth::guard('member')->user()->linkedin_email}} <i class="glyphicon glyphicon-remove"></i> 
                                        </a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        Linkedin Account
                                    </td>
                                    <td>
                                        <a href="/link/linkedin" data-toggle="tooltip" type="button" class="btn btn-sm btn-success">
                                            Link linkedin account
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endif
                        <div class="edit-profile-button">
                            @if((Auth::user() != null && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && Auth::guard('member')->user()->id == $user->id))
                                <a href="/editMyProfile/{{$user->id}}" data-original-title="Edit this user" 
                                    data-toggle="tooltip" type="button" class="btn btn-sm btn-warning">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>
                            @endif
                            @if(!Auth::guest() &&  Auth::user()->IsAdmin == 1)
                                <a onclick="return confirm('Do you want to delete this member?')" href="/members/{{$user->id}}/delete" data-original-title="Delete this user" 
                                    data-toggle="tooltip" type="button" class="btn btn-sm btn-danger pull-right">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            @endif
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection