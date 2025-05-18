<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function update(User $user, Post $post): bool
    {
        return auth()->user()->id === $post->user_id || $user->can('edit posts');
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || $user->can('delete posts');
    }

    public function create(User $user): bool
    {
        return true; // الكل يقدر يضيف بوست
    }
}
