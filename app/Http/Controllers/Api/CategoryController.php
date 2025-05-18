<?php

namespace App\Http\Controllers\Api;

use App\Enum\HttpStatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\PostResource;
use App\Services\Frontend\CategoryServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $resource = $this->service->index();
        return $this->response(CategoryResource::collection($resource), HttpStatusCodeEnum::OK);
    }
}
