@extends('layouts.apphome')

@section('title', 'Show Members')

@section('content')
<div class="container" style="min-height: 800px">
 AAAA
</div>
<!-- Start Team Member Section -->
    <section id="team" class="team-member-section">
        <div class="container">            
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title text-center">
                        <h3>Our New Members</h3>
                        <p>Duis aute irure dolor in reprehenderit in voluptate</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div id="team-section">
                        <div class="our-team">
                            @if (count($members[1]) > 0)
                                {{-- @php
                                    $i = 0;
                                @endphp --}}
                                @foreach ($members as $member)
                                    <div class="team-member">
                                        <img src="/storage/profile_image/{{$member->profile_image}}" class="img-responsive" alt="">
                                        <div class="team-details">
                                            <h4>{{$member->name}}</h4>
                                            <p>Alumni of STEI</p>
                                            <ul>
                                                <li><a href="/members/{{$member->id}}"><i class="fa fa-user"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- @php
                                        $i = $i + 1;
                                    @endphp --}}
                                @endforeach    
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Team Member Section -->
@endsection