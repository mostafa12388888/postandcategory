<?php

namespace App\Http\Controllers\Frontend;

use App\Enum\PaginationEnum;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Frontend\PostServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
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
    public function index(Request $request)
    {
        $posts = $this->service->allData($request->get("page", PaginationEnum::PAGE), $request->get("perPage", PaginationEnum::LIMIT), ['user']);

        return view('frontEnd.show-posts', compact('posts'));
    }
    /**
     * deletePost
     *
     * @param  mixed $request
     * @return void
     */
    public function deletePost(Request $request)
    {
        $post = Post::findOrFail($request->postId);

        $this->authorize('delete', $post);
        $this->service->deletePost($request->postId);
        Session::flash('success', 'your post DELETED successfully');
        return redirect()->back();
    }
}
