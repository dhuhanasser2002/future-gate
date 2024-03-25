<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
<<<<<<< HEAD
=======
        
>>>>>>> 838c40ebcf970f73ca00cc8fca2b1a40d80606c1
    ];


    public function posts() 
{ 
return $this->belongsToMany(Post::class); 
}


}
