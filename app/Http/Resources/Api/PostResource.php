<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'userId'=>$this->user_id,
            'commentAble'=>$this->comment_able,
            'numberOfViews'=>$this->number_of_views,
            "user"=>$this->user?UserResource::make($this->user):null,
            "images"=>$this->images?ImageResource::collection($this->images):[],
        ];
    }
}
