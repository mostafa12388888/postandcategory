<?php

namespace App\Repository\Frontend;

use App\Models\Comment;

use App\Repository\MainRepository;



class CommentRepository extends MainRepository
{


    /**
     * model
     *
     * @return string
     */
    public function model(): string
    {
        return Comment::class;
    }
    /**
     * getComments
     *
     * @param  mixed $postId
     * @return mixed
     */
    public function getPostComments($postId): mixed
    {
        $comment = $this->model->with('user')->where('post_id', $postId)->get();
        if (!$comment) return false;
        return $comment;
    }
}
