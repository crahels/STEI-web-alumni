@extends('layouts.app')

@section('title', 'Members List')

@section('content')
<div class="container-fluid">
        <div class="row">
          <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/members">
                    <span data-feather="users"></span>
                    Members List
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/dashboard/#">
                    <span data-feather="file"></span>
                    Articles
                  </a>
                </li>
              </ul>
            </div>
          </nav>
  
          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <h1 class="h2">Members List</h1>
              <button class="btn btn-primary">Add Member</button>
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
        </div>
      </div>

      <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
@endsection