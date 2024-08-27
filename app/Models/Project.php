<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'technique',
        'description',
        'github',
        'mainimage',
        'user_id'
    ];
    public function images(){
        return $this->hasMany(ProjectImage::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
