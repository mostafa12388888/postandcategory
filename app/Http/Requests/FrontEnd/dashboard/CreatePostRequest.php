<?php

namespace App\Http\Requests\frontend\dashboard;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string|min:2|max:200',
            'desc'=>'required|min:10|string',
            'commentAble'=>'in:on,off',
            'categoryId'=>'required|numeric|exists:categories,id',
            "images"=>'required',
            "images.*"=>"image|mimes:png,jpg"
        ];
    }
}
