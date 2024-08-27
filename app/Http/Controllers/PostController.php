<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\StudentRequest;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        $studentrequest = StudentRequest::where('approved', False);
        $posts =  Post::with('comments',  'user')->orderBy('created_at', 'desc')->get();
        $tags = Tag::all();
        return view('posts.index', compact('posts', 'tags', 'studentrequest'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //add auth to create
        $this->authorize('create', Post::class);
        $studentrequest = StudentRequest::where('approved', False);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags', 'studentrequest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        $post = new Post();
        $post->title = $request->input('title');
        $post->postContent = $request->input('content');
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->input('category_id');
        $post->created_at;
        $post->updated_at;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $post->image = $image_name;
        }
        $post->save();
        $post->tags()->attach($request->tag_id);
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    public function sortBycategory(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->get();
        $studentrequest = StudentRequest::where('approved', False);

        return view('posts.index', compact('posts', 'studentrequest'));
    }


    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required'
        ]);
        $query = $request->input('query');

        $posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('postContent', 'like', '%' . $query . '%')
            ->get();
        $studentrequest = StudentRequest::where('approved', False);

        return view('posts.index', compact('posts', 'studentrequest'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post, User $user, Category $category)
    {
        $post->comments();
        //$category = Post::where('category_id',$category->id)->get();
        $user = auth()->user();
        $tags[] = $post->tags;
        $users = Post::where('user_id', $user->id)->get();
        $studentrequest = StudentRequest::where('approved', False);
        $this->authorize('view', $post);
        return view('posts.show', compact('post', 'studentrequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        $studentrequest = StudentRequest::where('approved', False);
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags', 'studentrequest'));
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
        $post->category_id = $request->input('category_id');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        $post->save();
        $post->tags()->sync($request->tag_id);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post archived successfully');
    }

    public function trash()
    {
       $userId = auth()->id(); 
       $studentrequest = StudentRequest::where('approved', False)->where('user_id', $userId) ->get();
       $asrchivedPosts = Post::onlyTrashed() ->where('user_id', $userId)  ->get();
       return view('posts.archives', compact('asrchivedPosts', 'studentrequest'));
     }
    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        if ($post) {
            $post->restore();
            return redirect()->route('posts.index')->with('success', 'Post unarchive successfully');
        }
        return redirect()->route('posts.index')->with('error', 'Post not found');
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->find($id);
        if ($post) {
            $post->forceDelete();
            return redirect()->route('posts.index')->with('success', 'Post delete successfully');
        }
        return redirect()->route('posts.index')->with('error', 'Post not found');
    }
}
