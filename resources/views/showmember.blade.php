@extends('layouts.apphome')

@section('title', 'Members List')

@section('content')
<!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <img src="{{URL::asset('storage/banner.jpg')}}" id="bannerMember">
</div>-->
<div class="col-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 showmember-table" style="min-height: 60em; overflow-x: auto">
    <div class="row" style="margin-top: 1%">
            <div class="col-md-12 col-sm-12">
                <div class="section-title text-center">
                    <h3>Our Members</h3>
                    <p style="padding-bottom: 5%">Meet all members of Web Alumni STEI ITB!</p>
                </div>
            </div>
        </div>
    @if(count($members) > 0)
    <table class="table table-bordered">
    <thead class="thead-light custom-thread">
        <tr class="table-text">
        <th scope="col-3">Student ID</th>
        <th scope="col-6">Name</th>
        <th scope="col-3">Email Address</th>
        <th scope="col-3">Status</th>
        </tr>  
    </thead>
    <tbody>
        @foreach($members as $member)
        <tr class="table-text">
            <td>{{$member->nim}}</td>
            <td><a href="/admin/members/{{$member->id}}">{{$member->name}}</a></td>
            <td>{{$member->email}}</td>
            @if ($member->verified == 0)
            <td style="color:red;">not verified</td>
            @else
            <td>verified</td>
            @endif
        </tr>
        @endforeach
    </tbody>
    </table>
    <ul class="pagination text-center" style="display: block">{{$members->links()}}</ul>
    @else
        <p>No member.</p>
    @endif
</div>
<script>
    document.getElementById("nav-two").classList.add("active");
    document.getElementById("text-nav-two").classList.add("color-active");
</script>
  @endsection