<?php
namespace App\Repository\Frontend;

use App\Models\Category;
use App\Repository\MainRepository;



class CategoryRepository extends MainRepository
{


    /**
     * model
     *
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }
    /**
     * index
     *
     * @return mixed
     */
    public function index():mixed
    {
        return $this->model->get();
    }
    /**
     * categoryPostLimit
     *
     * @return mixed
     */
    public function categoryPostLimit():mixed
    {
        $categories= $this->model->get();
         $categoryWithPost = $categories->map(
             function ($category) {
                 $category->posts = $category->posts()->limit(5)->get();
                 return $category;
             }
         );
         return $categoryWithPost;
     }



}
