@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">

        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <h1>New post</h1>
                <div class="form-group row">

                    <label for="caption" class="col-md-4 col-form-label">Post Caption</label>
                    
                    <input id="caption"
                        name="caption"
                        type="text"
                        class="form-control @error('caption') is-invalid @enderror"
                        value="{{ old('caption') }}" autocomplete="caption" autofocus>

                    @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-8 offset-2">
                <div class="form-group row">
                <button class="btn btn-primary">Add new post</button>
                </div>
            </div>
        </div>
    
    </form>
</div>
@endsection
