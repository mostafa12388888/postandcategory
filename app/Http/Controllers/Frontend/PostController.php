<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\CommentRequest;
use App\Services\Frontend\PostServices;

class PostController extends Controller
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
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show($slug)
    {
        $mainPost=$this->service->getPostWithComments($slug);
       $category_posts= $this->service->getCategoryPosts( $mainPost->category_id);
        $this->service->incrementPostViews($mainPost->id);
        return view('frontEnd.show', compact('mainPost', 'category_posts'));
    }
    /**
     * getAllComments
     *
     * @param  mixed $slug
     * @return void
     */
    public function getAllComments($slug)
    {
        $post=$this->service->firstOrFailBy(["slug" => $slug], ["comments"]);
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(CommentRequest $request)
    {
        $comment = $this->service->storeComment(
            array_merge($request->all(), [
                'ip_address' => $request->ip(),
            ])
        );
        $comment->load('user');
        return response()->json([
            'msg' => 'comment stored successfully',
            'data' => $comment,

        ]);
    }
}
