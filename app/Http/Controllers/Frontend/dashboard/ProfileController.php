<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Enum\PaginationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\dashboard\CreatePostRequest;
use App\Models\Post;
use App\Services\Frontend\PostServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
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
     * @return void
     */
    public function index()
    {
        $posts = $this->service->findAll(['user_id'=>auth()->user()->id],['images']);
        return view('frontEnd.dashboard.profile', compact('posts'));
    }
    /**
     * storePost
     *
     * @param  mixed $request
     * @return void
     */
    public function storePost(CreatePostRequest $request)
    {
        $resource = $this->service->storePost($request->all());
        Session::flash('success', 'your post created successfully');
        return redirect()->back();
        // Session::flash('error', $error->getMessage());
    }
    /**
     * editPost
     *
     * @param  mixed $slug
     * @return void
     */
    public function editPost($slug)
    {
        $post = $this->service->firstOrFailBy(["slug" => $slug], ["images"]);
        $this->authorize('update', $post);
        return view('frontEnd.dashboard.edit-post', compact('post'));
    }
    /**
     * updatePost
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updatePost(CreatePostRequest $request, $id)
    {
        $post = $this->service->updatePost($id, $request->all());
        $this->authorize('update', $post);

        Session::flash('success', 'your post update successfully');
        return redirect()->back();
    }
    /**
     * deletePost
     *
     * @param  mixed $request
     * @return void
     */
    public function deletePost(Request $request)
    {
        $post = $this->service->deletePost($request->postId);
        $this->authorize('delete', $post);
        session()->flash('success', 'delete successfully');
        return redirect()->back();
    }
    /**
     * getComments
     *
     * @param  mixed $id
     * @return void
     */
    public function getComments($id)
    {

        $comment = $this->service->getPostComments($id);
        return response()->json([
            'data' => $comment,
            'message' => 'those you have comments',
        ]);
    }
}
