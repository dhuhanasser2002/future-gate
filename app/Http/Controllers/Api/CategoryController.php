<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
=======
use App\Models\Category;
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
use Illuminate\Http\Request;

class CategoryController extends Controller
{
<<<<<<< HEAD
    //
}
=======
    public function index(){

        $categories = Category::all();

        return response()->json($categories);
    }

    public function show(Category $category){  

            return response()->json($category,200);
    }
}
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
