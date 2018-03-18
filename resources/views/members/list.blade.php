@extends('layouts.app')

@section('title', 'Web Alumni STEI | Member List')

@section('content')
    <h1>Members List</h1>
    
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
@endsection