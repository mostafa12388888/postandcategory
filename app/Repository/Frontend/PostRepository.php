<?php
namespace App\Repository\Frontend;

use App\Models\Post;
use App\Repository\MainRepository;



class PostRepository extends MainRepository
{


    /**
     * model
     *
     * @return string
     */
    public function model(): string
    {
        return Post::class;
    }
    /**
     * index
     *
     * @return mixed
     */
    /**
     * index
     *
     * @return mixed
     */
    public function index():mixed
    {
        return $this->model->where('user_id',auth()->user()->id)->with('images')->latest()->get();
    }
    /**
     * getPostWithComments
     *
     * @param  mixed $slug
     * @return void
     */
    public function getPostWithComments($slug):mixed
    {
        return $this->model->with(['comments' => function ($query) {
            $query->limit(3);
        }])
        ->whereSlug($slug)
        ->firstOrFail();
    }

    /**
     * getCategoryPosts
     *
     * @param  mixed $categoryId
     * @return void
     */
    public function getCategoryPosts($categoryId):mixed
    {
        return $this->model->where('category_id', $categoryId)
                    ->latest()
                    ->limit(5)
                    ->get();
    }

    /**
     * incrementPostViews
     *
     * @return void
     */
    public function incrementPostViews($postId)
    {
        $this->model->find($postId)->increment('number_of_views');
    }

}
