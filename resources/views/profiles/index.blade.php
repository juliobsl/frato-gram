@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="/img/logo.jpg" alt="" class="rounded-circle" style="width: 100px">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <a href="/p/create"> Add new post</a>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> publicações</div>
                <div class="pr-5"><strong>110</strong> seguidores</div>
                <div class="pr-5"><strong>118</strong> seguindo</div>

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
                    <img src="/storage/{{$post->image}}" class="w-100" alt="">
                </div>
        @endforeach
        
    </div>
</div>
@endsection
