@extends('layouts.app')

@section('title', 'Members List')

@section('content')
      @include('inc.adminmenu')
  
      <main role="main" class="col-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <img src="{{URL::asset('storage/banner.jpg')}}" id="bannerMember">
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Members List</h1>
          <a href="/addmember" class="btn btn-primary">Add Member</a>
        </div>
        @if(count($members) > 0)
            @foreach($members as $member)
                <div class="list-group-item">
                <h4><a href="/members/{{$member->id}}">{{$member->name}}</a></h4>
                </div>
            @endforeach
            <ul class="pagination pull-right">{{$members->links()}}</ul>
        @else
            <p>No member.</p>
        @endif
      </main>
@endsection