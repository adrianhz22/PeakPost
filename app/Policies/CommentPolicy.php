<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{

    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id || $user->hasAnyRole(['admin', 'moderator']);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id || $user->hasAnyRole(['admin', 'moderator']);
    }

}
