@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="center">Feed</h2>
        @foreach ($posts as $post)
            <div class="row">                
                    <div class="col-6 offset-3">
                        <a href="/profile/{{ $post->user->id}}">
                            <img src="/storage/{{$post->image}}" alt="Imagem da postagem nº {{$post->id}}" class="w-100">
                        </a>
                    </div>
            </div>

            <div class="row">
                <div class="col-6 offset-3 pt-2 pb-4">
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
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <!-- $links gerado automaticamente ao utilizar a função paginate no controller -->
            {{$posts->links("pagination::bootstrap-4")}}
        </div>
    </div>

    
</div>
@endsection
