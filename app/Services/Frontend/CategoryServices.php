<?php

namespace App\Services\Frontend;

use App\Repository\Frontend\CategoryRepository;
use App\Repository\MainRepository;
use App\Services\MainService;

class CategoryServices extends MainService
{
    /**
     * @var CategoryRepository
     */
    protected MainRepository $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     * @return void
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }
    public function index(){
        return $this->repository->index();
    }


}
