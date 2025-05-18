<?php

namespace App\Services\Frontend;

use App\Helpers\FileHelper;
use App\Repository\Frontend\PostRepository;
use App\Repository\MainRepository;
use App\Services\MainService;
use Illuminate\Support\Facades\Cache;

class PostServices extends MainService
{
    /**
     * @var PostRepository
     */
    protected MainRepository $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     * @return void
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }
    /**
     * index
     *
     * @param  mixed $page
     * @param  mixed $perPage
     * @return mixed
     */
    public function index(): mixed
    {
        return $this->repository->index();
    }

    /**
     * store
     *
     * @param  mixed $data
     * @return mixed
     */
    public function storePost(array $data): mixed
    {

        $post = $this->add([
            'user_id' => auth()->user()->id??1,
            'category_id' => $data['categoryId'],
            'comment_able' => $data['commentAble'] == "on" ? 1 : 0,
            'desc' => $data['desc'],
            'title' => $data['title'],
        ]);
        app(ImageServices::class)->storeImage($data['images'], $post->id);
        Cache::forget('readMorePosts');
        Cache::forget('latestPost');
        return $post;
    }
    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return mixed
     */
    public function updatePost(int $id, array $data): mixed
    {
        $post = $this->findOrFail($id);

        return $this->update($id, [
            'category_id' => $data['categoryId'],
            'comment_able' => $data['commentAble'] == "on" ? 1 : 0,
            'desc' => $data['desc'],
            'title' => $data['title'],
        ]);
        app(ImageServices::class)->storeImage($data['images'], $post->id);
        return $post;
    }
    /**
     * deletePost
     *
     * @param  mixed $id
     * @return void
     */
    public function deletePost($id): mixed
    {
        $post = $this->find($id);
        if (!$post) return false;
        if ($post->images->count()) {
            foreach ($post->images as $image)
                FileHelper::deleteFile('/storage' . $image->path);
        }
        return $post->delete();
    }
    /**
     * getPostComments
     *
     * @param  mixed $postId
     * @return mixed
     */
    public function getPostComments($postId): mixed
    {
        return app(CommentServices::class)->getPostComments($postId);
    }
    /**
     * storeComment
     *
     * @param  mixed $data
     * @return mixed
     */
    public function storeComment(array $data): mixed
    {
        return app(CommentServices::class)->storeComment($data);
    }

    /**
     * getPostWithComments
     *
     * @param  mixed $slug
     * @return mixed
     */
    public function getPostWithComments($slug): mixed
    {
        return $this->repository->getPostWithComments($slug);
    }
    /**
     * getCategoryPosts
     *
     * @param  mixed $categoryId
     * @return mixed
     */
    public function getCategoryPosts($categoryId): mixed
    {
        return $this->repository->getCategoryPosts($categoryId);
    }
    /**
     * allCategory
     *
     * @return mixed
     */
    public function allCategory():mixed
    {
       return app(CategoryServices::class)->index();
    }
    /**
     * allCategoryPostLimit
     *
     * @return mixed
     */
    public function allCategoryPostLimit():mixed
    {
       return app(CategoryServices::class)->categoryPostLimit();
    }
    /**
     * incrementPostViews
     *
     * @return void
     */
    public function incrementPostViews($postId)
    {
        return $this->repository->incrementPostViews($postId);
    }
}
