<?php

namespace App\Http\Controllers\Frontend;

use App\Enum\PaginationEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\Frontend\PostServices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * service
     *
     * @var PostServices
     */
    protected PostServices $service;
    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct(PostServices $service)
    {
        $this->service = $service;
    }
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    function index(Request $request)
    {

        $posts = $this->service->allData(
            $request->get("page", PaginationEnum::PAGE),
            $request->get("perPage", PaginationEnum::LIMIT),
            ['images'],
            columns: ['id', 'title', 'slug']
        );
        $grate_of_views = $this->service->findAll(with: ['images'], columns: ['id', 'title', 'slug'], orderBy: 'number_of_views', limit: 3);
        $oldestNews = $this->service->findAll(with: ['images'], columns: ['id', 'title', 'slug'], limit: 3);
        $gratePostComments = $this->service->findAll(with: ['images'], withCount: ['comments'], columns: ['id', 'title', 'slug'], orderBy: 'comments_count', limit: 3);
        $categories = $this->service->allCategory();
        $categoryWithPost = $this->service->allCategoryPostLimit();

        return view('frontend.index', compact('posts', 'grate_of_views', 'oldestNews', 'gratePostComments', 'categories', 'categoryWithPost'));
    }
}
