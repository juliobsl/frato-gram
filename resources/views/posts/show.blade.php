@extends('layouts.app')

@section('content')
<div class="container">
<div class="row border white pt-3 pb-3">
    <div class="col-8">
        <img src="/storage/{{$post->image}}" alt="Imagem da postagem nº {{$post->id}}" class="w-100">
    </div>
    <div class="col-4">
        <div class="d-flex align-items-center">
            <div class="pr-3">
                <img src="{{ $post->user->profile->profileImage() }}"
                    alt="Profile picture of the user"
                    class="rounded-circle w-100"
                    style="max-width:35px;">
            </div>
            <div>
                <div class="font-weight-bold">
                    <a href="/profile/{{ $post->user->id}}" style="text-decoration:none;">
                        <span class="text-dark">{{ $post->user->username}}</span>
                    </a>
                    <a href="#" class="pl-3" style="text-decoration:none;"><b>Follow</b></a>
                </div>
            </div>
        </div>
        <hr>
        <p>
            <span class="font-weight-bold">
                <a href="/profile/{{ $post->user->id}}" style="text-decoration:none;">
                    <span class="text-dark">{{ $post->user->username}}</span>
                </a>
            </span> 
            {{ $post->caption}}
        </p>
    </div>
</div>
    
</div>
@endsection
