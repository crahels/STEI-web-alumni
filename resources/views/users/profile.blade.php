@extends('layouts.app')

@section('title', $user->name . ' | Profile')

@section('content')
    <h2 class="sub-title">Profile</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >  
            <div class="panel panel-info">
                <div class="panel-heading">
                <h3 class="panel-title">{{$user->name.' ('.$user->nim .')'}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" 
                        src="/storage/profile_image/{{$user->profile_image}}" 
                        class="img-circle img-responsive" id=""> </div>
                        
                            <div class=" col-md-9 col-lg-9 "> 
                                <table class="table table-user-information">
                                    <tbody>
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
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <div class="panel-footer">
                        @if((Auth::user() != null && Auth::user()->IsAdmin == 1) || (Auth::guard('member')->user() != null && Auth::guard('member')->user()->id == $user->id))
                            <a href="/members/{{$user->id}}/edit" data-original-title="Edit this user" 
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
                </div>
            </div>
        </div>
        <h2 class="sub-title"><a href="/members" class="btn btn-info">&#8592; Back</a></h2>

@endsection