<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcomeMail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // função nativa 
    protected static function boot()
    {
        parent::boot();

        //no momemento de criação do User para fazer ações
        static::created( function ($user){
            $user->profile()->create([
                'title' => $user->username,
            ]);

            // sending emails
            Mail::to($user->email)->send(new NewUserWelcomeMail());



        });
    }

    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');
        // created_at é criado automaticamente pela função "timestamps" no momento de declaração da migration
    }

    public function following(){
        return $this->belongsToMany(Profile::class);        
    }
    public function profile(){
        return $this->hasOne(Profile::class);
    }



}
