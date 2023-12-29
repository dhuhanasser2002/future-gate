<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    
    public function viewAny(User $user): bool
    {
        return true;
    }

    
    public function view(User $user, Comment $comment): bool
    {
        return true;
    }

   
    public function create(User $user): bool
    {
        return true;
    }

   
    public function update(User $user, Comment $comment): bool
    {
        return $user->id ===  $comment->user_id;
    }

    
    public function delete(User $user, Comment $comment): bool
    {
        
        return $user->id ===  $comment->user_id || $user->id === $comment->post->user_id;

    }
    public function restore(User $user, Comment $comment): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comment $comment): bool
    {
        //
    }
}

