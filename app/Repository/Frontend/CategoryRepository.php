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
    public function index(){
        return $this->model->get();
    }


}
