@extends('layouts.app')
@section('title', 'Members List')
  @section('content')
    @include('inc.adminmenu')
      <main role="main" class="col-7">
        <!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <img src="{{URL::asset('storage/banner.jpg')}}" id="bannerMember">
        </div>-->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">List of Members</h1>
          <a class="btn btn-primary" href="/admin/add">
            Add Member
          </a>
        </div>
        @if(count($members) > 0)
        <table class="table table-bordered">
          <thead class="thead-light custom-thread">
            <tr>
              <th scope="col-3">Student ID</th>
              <th scope="col-6">Name</th>
              <th scope="col-3">Email Address</th>
              <th scope="col-3">Status</th>
            </tr>  
          </thead>
          <tbody>
            @foreach($members as $member)
              <tr>
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
          <ul class="pagination pull-right">{{$members->links()}}</ul>
        @else
            <p>No member.</p>
        @endif
      </main>
      <script>
        document.getElementById("nav-two").classList.add("active");
        document.getElementById("text-nav-two").classList.add("color-active");
      </script>
  @endsection