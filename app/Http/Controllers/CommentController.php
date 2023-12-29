<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Comment::class);

        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',

        ]);
        $comments = new Comment();
        $comments->content = $request->input('content');
        $comments->user_id = auth()->user()->id;
        $comments->post_id = $post->id;
        
        $comments->save();
        return redirect()->route('posts.show',$post)->with('success', 'comment created successfully');
       
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment )
    {
        $this->authorize('update', $comment);

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            
            'content' => 'required',
        ]);
        $comment->content = $request->input('content');
        
        $comment->save();

        return redirect()->route('posts.show',$comment->postId)->with('success', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully');
    }
}
