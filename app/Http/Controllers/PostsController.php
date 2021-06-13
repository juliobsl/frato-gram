<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //verificação de login 
    }
    public function create(){
        return view('posts/create');
    }

    public function store()
    {
        $data = request()->validate([
            //'another_no_validate' => '',
            'caption' => 'required',
            'image' => ['required','image']
        ]);

        $imagePath =  request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,

        ]); // captura do usuário que possui a relação hasmany em posts e cria essa relação

        return redirect('/profile/' . auth()->user()->id);
        // redirecionamento seguro pois o controle de auth ja foi adicionado como middleware
    }
}
