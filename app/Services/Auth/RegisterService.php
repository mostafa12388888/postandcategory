<?php

namespace App\Services\Auth;

use App\Helpers\FileHelper;
use App\Models\User;
use App\Services\Frontend\UserServices;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    /**
     * createUser
     *
     * @param  mixed $data
     * @return User
     */
    public function createUser(array $data): User
    {
        $file = FileHelper::uploadFile($data['image'], 'userImage');
        return User::create([
            'name' => $data['name'],
            'user_name' => $data['userName'],
            'country' => $data['country'],
            'city' => $data['city'],
            'street' => $data['street'],
            'phone' => $data['phone'],
            'roles_name' => ['user'],
            'image' => $file,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
