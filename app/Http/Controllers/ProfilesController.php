<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    
    public function index($user)
    {
        $user = User::findOrFail($user);


        $follows= (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        
        // $postCount = $user->posts->count();
        // $followersCount = $user->profile->followers->count();
        // $followingCount = $user->following->count();

        // CACHING
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            //now()->addDay(),
            //now()->addDays(2), etc
            now()->addSeconds(30),
            function () use ($user){
            return $user->posts->count();
        });

        $followersCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user){
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user){
            return $user->following->count();
        });   

       
        // modo simples, diferente de posts controller em que o laravel busca no model automaticamente
        // return view('profiles.index',[
        //     'user' => $user,
        //     'follows' => $follows
        // ]);

        return view('profiles/index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);      


        return view('profiles/edit', compact('user'));

    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' =>''
        ]);

        
        if(request('image')){
            $imagePath =  request('image')->store('profile', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);    
            $image->save();

            $imageArray = ['image' => $imagePath];

        }
        
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));



        return redirect("/profile/{$user->id}");
        //dd($data);
    }
}
