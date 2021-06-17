@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" alt="" class="w-100 rounded-circle" style="width: 140px">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h3">{{ $user->username }}</div>
                    <!-- vue button component, props: user-id -->
                    @if ( $user->id != Auth::user()->id)
                        <follow-button follows="{{ $follows }}" user-id="{{ $user->id }}"></follow-button>
                    @endif
                </div>
                @can ('update', $user->profile)
                    <a href="/p/create"> Add new post</a>
                @endcan
            </div>
            <!-- restrição  -->
            @can ('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit profile</a>
            @endcan

            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postCount }}</strong> publicações</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> seguidores</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> seguindo</div>

            </div>
            <div class="pt-4" style="line-height: 1;">
                <span class="font-weight-bold">{{ $user->profile->title }}</span><br>
                <!-- <span style="color:gray">Empresa de tecnologia da informação</span><br> -->
                {{ $user->profile->description }}<br>
                <a href="#">{{ $user->profile->url }}</a>
                <!-- <a href="#">{{ $user->profile->url ?? 'N/A'}}</a> -->

            </div>
            
        
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{$post->id}}">
                        <img src="/storage/{{$post->image}}" class="w-100" alt="">
                    </a>
                </div>
        @endforeach
        
    </div>
        


</div>
@endsection
