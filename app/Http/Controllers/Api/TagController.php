<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
=======
use App\Models\Tag;
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
use Illuminate\Http\Request;

class TagController extends Controller
{
<<<<<<< HEAD
    //
=======
    public function index(){

        $tags = Tag::all();

        return response()->json($tags);
    }

    public function show(Tag $tag){  

            return response()->json($tag,200);
    }
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
}
