<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Post::class);

        $posts = Post::all();

            return response()->json($posts);
        
       
        
    }

    public function store(Request $request )
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tag_id' => 'required|exists:tags,id'

        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);


        }
        $post = Post::create([
        'title' => $request->input('title'),
        'postContent' => $request->input('content'),
        'user_id' => auth()->user()->id,
        'category_id' => $request->input('category_id') ,
        'image' => $image_name
        ]);
        $post->tags()->attach($request->tag_id);
        return response()->json([
             "message" => "post added successfully"], 201);
    }


    public function show(Post $post , Category $category , User $users ,Comment $comments){
    
       $comments = Comment::where('post_id',$post->id)->get();
        $category = Post::where('category_id',$category->id)->get();
        $tags[] = $post->tags;
        $user = auth()->user();
        $users = Post::where('user_id',$user->id)->get();
        $this->authorize('view', $post);
        $response = [
            'status' => 'success',
            'data' => [
                'post' => $post,
                'user' => $users,
                'comment' => $comments,
                'category' => $tags,
                'tag' => $tags
            ]];
            return response()->json($response,200);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        
        $post->title = $request->input('title');
        $post->postContent = $request->input('content');
        $post->category_id = $request->input('category_id') ;
        $post->tags;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }
        $post->tags()->attach($request->tag_id);

        $post->update();

        return response()->json([
             "message" => "post updated successfully",
             $post], 201);
          
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'post is deleted successfully'
        ], 202);
    }
    
}