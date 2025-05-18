<?php

namespace App\Services\Frontend;

use App\Repository\Frontend\CommentRepository;
use App\Repository\MainRepository;
use App\Services\MainService;

class CommentServices extends MainService
{
    /**
     * @var CommentRepository
     */
    protected MainRepository $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     * @return void
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }
    /**
     * getPostComments
     *
     * @param  mixed $postId
     * @return mixed
     */
    public function getPostComments($postId): mixed
    {
        return $this->repository->getPostComments($postId);
    }
    /**
     * storeComment
     *
     * @param  mixed $data
     * @return mixed
     */
    public function storeComment(array $data): mixed
    {
        $comment = $this->add([
            'user_id' => $data['userId'],
            'comment' => $data['comment'],
            'post_id' => $data['postId'],
            "ip_address" => $data['ip_address'],
        ]);
        return $comment;
    }
}
