<?php

namespace App\Http\Requests\frontend\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'image' => "nullable|image|mimes:png,jpg",
            'name' => "required|string|min:2|max:150",
            'username' => "required|string|min:2|max:150|unique:users,user_name," . auth()->user()->id,
            'country' => "required|string|min:2|max:150",
            'city' => "required|string|min:2|max:150",
            'street' => "required|string|min:2|max:150",
            'phone' => "required|min:8|max:16|unique:users,phone," . auth()->user()->id,
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
        ];
    }
}
