<?php

namespace App\Http\Controllers\Api;

use App\Enum\HttpStatusCodeEnum;
use App\Enum\PaginationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\dashboard\CreatePostRequest;
use App\Http\Resources\Api\PostResource;
use App\Services\Frontend\PostServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * Display a listing of the resource.
     */
    /**
     * index
     *
     * @param  mixed $request
     * @param  mixed $type
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {

        $paginator = $this->service->allData(
            $request->get("page", PaginationEnum::PAGE),
            $request->get("perPage", PaginationEnum::LIMIT),
            ['user', 'images'],
            columns: ['id', 'title', 'slug', 'user_id', 'comment_able', 'number_of_views']
        );
        $resource = PostResource::collection($paginator);
        return $this->response($this->formatPagination($resource, $paginator), HttpStatusCodeEnum::OK);
    }
    /**
     * userPosts
     *
     * @param  mixed $request
     * @return void
     */
    public function userPosts(Request $request)
    {
        $resource = $this->service->findAll(
            ['user_id'=>auth()->user()->id ?? 1],
            ['images'],

            columns: ['id', 'title', 'slug', 'user_id', 'comment_able', 'number_of_views']
        );

        return $this->response(PostResource::collection($resource), HttpStatusCodeEnum::OK);
    }
    /**
     * postComments
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function postComments($id): JsonResponse
    {
        $resource = $this->service->firstOrFailBy(["id" => $id], ['user', 'images', 'comments']);
        return $this->response(PostResource::make($resource), HttpStatusCodeEnum::OK);
    }
    /**
     * addPost
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function addPost(CreatePostRequest $request): JsonResponse
    {
        $resource = $this->service->storePost($request->all());
        return $this->response(PostResource::make($resource), HttpStatusCodeEnum::OK);
    }
    /**
     * editPost
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return JsonResponse
     */
    public function editPost(CreatePostRequest $request, $id): JsonResponse
    {
        $resource = $this->service->updatePost($id, $request->all());
        return $this->response(PostResource::make($resource), HttpStatusCodeEnum::OK);
    }
    /**
     * deletePost
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function deletePost($id): JsonResponse
    {
        $this->service->deletePost($id);
        return $this->response([], HttpStatusCodeEnum::OK);
    }
}
