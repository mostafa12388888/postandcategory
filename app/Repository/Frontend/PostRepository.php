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
     * incrementPostViews
     *
     * @return void
     */
    public function incrementPostViews($postId)
    {
        $this->model->find($postId)->increment('number_of_views');
    }

}
