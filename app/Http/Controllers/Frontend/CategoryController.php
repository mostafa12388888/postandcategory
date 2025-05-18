<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\CategoryServices;

class CategoryController extends Controller
{
    /**
     * service
     *
     * @var CategoryServices
     */
    protected CategoryServices $service;
    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct(CategoryServices $service)
    {
        $this->service = $service;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category = $this->service->firstOrFailBy(["slug" => $slug], ["posts"]);
        $posts = $category->posts()->latest()->paginate(9);
        return view('frontEnd.category_posts', compact('posts','category'));
    }
}
