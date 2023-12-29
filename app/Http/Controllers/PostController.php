<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);

        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        //add auth to create
        $this->authorize('create', Post::class);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request )
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);
        $post = new Post();
        $post->title = $request->input('title');
        $post->postContent = $request->input('content');
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->input('category_id') ;
       

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $post->image = $image_name;

        }
        $post->save();
        $post->tags()->attach($request->tag_id);
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(Post $post, User $user , Category $category , Tag $tag)
    {   $comments = Comment::where('post_id',$post->id)->get();
        $category = Post::where('category_id',$category->id)->get();
        $tags[] = $post->tags;
        $user = auth()->user();
        $users = Post::where('user_id',$user->id)->get();
        $this->authorize('view', $post);
        return view('posts.show', compact('post','user','comments','users','category', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
