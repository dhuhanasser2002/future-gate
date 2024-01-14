<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Post extends Model
{
    use HasApiTokens, HasFactory, Notifiable , softDeletes;
    protected $fillable = [
        'title',
        'postContent',
        'image',
        'user_id',
        'category_id',
    ];

public function user() 
{ 
return $this->belongsTo(User::class); 
}

public function comments() 
{ 
return $this->hasMany(Comment::class); 
}

public function category() 
{ 
return $this->belongsTo(Category::class); 
}

public function tags() 
{ 
return $this->belongsToMany(Tag::class); 
}
}
