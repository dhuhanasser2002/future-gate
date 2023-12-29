<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user)
    {

        return true; // For example, everyone can view the index
    }

    public function view(User $user, Post $post)
    {
        return true; // Example: everyone can view posts
    }

    public function create(User $user)
    {
        return true; // Example: everyone can create a post
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id; // Example: only the post owner can update
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id; // Example: only the post owner can delete
    }
}
