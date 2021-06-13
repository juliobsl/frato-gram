<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = []; // remoção de verifição da função $fillable pois já esta sendo feita a validação na request

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
