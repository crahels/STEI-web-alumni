@extends('layouts.app')

@section('title', $user->name . ' | Profile')

@section('content')
    <h1>{{$user->name}}</h1>
    <div>Email: {{$user->email}}</div>
    <div>Nomor HP: {{$user->phone_number}}</div>
    <div>Perusahaan: {{$user->company}}</div>
    <div>Interest: {{$user->interest}}</div>
    <div>Alamat: {{$user->address == null ? '-' : $user->address}}</div>
    <a href="/profile/{{$user->id}}/edit" class="btn btn-dark">Edit Profile</a>
@endsection