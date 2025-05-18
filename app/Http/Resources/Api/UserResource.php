<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            'userName'=>$this->user_name,
            'image'=>$this->image,
            'status'=>$this->status,
            'role'=>$this->role,
            'rolesName'=>$this->roles_name,
            'street'=>$this->street,
            'city'=>$this->city,
            'country'=>$this->country,
            'email'=>$this->email,
        ];
    }
}
