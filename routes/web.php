<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/email', function(){
    return new App\Mail\NewUserWelcomeMail();
});

Route::post('follow/{user}', 'App\Http\Controllers\FollowsController@store');

// ORDEM DAS ROTAS
// na seguinte ordem há conflito pois é capturado após '/p/' com '{post}' e não atinge segunda linha
//Route::get('/p/{post}', 'App\Http\Controllers\PostsController@show');
//Route::get('/p/create', 'App\Http\Controllers\PostsController@create');
// ordem correta:

Route::get('/', 'App\Http\Controllers\PostsController@index');
Route::get('/p/create', 'App\Http\Controllers\PostsController@create');
Route::get('/p/{post}', 'App\Http\Controllers\PostsController@show');



Route::post('/p', 'App\Http\Controllers\PostsController@store');

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

Route::get('/profile/{user}/edit', 'App\Http\Controllers\ProfilesController@edit')->name('profile.edit'); // exibição do formulário

Route::patch('/profile/{user}', 'App\Http\Controllers\ProfilesController@update')->name('profile.update'); // action do formulario
