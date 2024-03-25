<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
=======
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
use Illuminate\Http\Request;

class CommentController extends Controller
{
<<<<<<< HEAD
    //
=======
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
            'postid' => 'required|exists:posts,id'

        ]);
        $comments = new Comment();
        $comments->content = $request->input('content');
        $comments->user_id = auth()->user()->id;
        $postid = $post->id;
        $comments->post_id = $request->postid;
        
        $comments->save();
        return response()->json([
            "message" => "comment added successfully"], 201);
      
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
       
        $comment->content = $request->input('content');
        
        $comment->update();

        return response()->json([
            "message" => "comment updated successfully",
            $comment], 201);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'comment is deleted successfully'
        ], 202);
    }

>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
}
