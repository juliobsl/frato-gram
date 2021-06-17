<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //verificação de login 
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        //$posts = Post::whereIn('user_id', $users)->latest()->get();
        
        // paginação com eloquente
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
        //dd($posts);
        
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

        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,

        ]); // captura do usuário que possui a relação hasmany em posts e cria essa relação

        return redirect('/profile/' . auth()->user()->id);
        // redirecionamento seguro pois o controle de auth ja foi adicionado como middleware
    }

    // Route Model Binding
    public function show(\App\Models\Post $post) // referencia do Model post utilizando funcionalidade patrão do laravel de 'fetching' - handler automatico de 404, diferente do que foi feito em ProfilesController
    {
       return view('posts/show', compact('post')); // binding utilizando a função compact, diferente de Profiles Controller
    }

    
}
