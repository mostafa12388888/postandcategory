<?php

namespace App\Services\Frontend;

use App\Helpers\FileHelper;
use App\Repository\Frontend\SettingRepository;
use App\Repository\Frontend\UserRepository;
use App\Repository\MainRepository;
use App\Services\MainService;

class UserServices extends MainService
{
    /**
     * @var UserRepository
     */
    protected MainRepository $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }
    /**
     * settingUpdate
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return mixed
     */
    public function userUpdate(array $data): mixed
    {
        $user = $this->findOrFail(auth()->user()->id);
        if (isset($data['image']) && $data['image']) {
            FileHelper::deleteFile('/storage' . $user->image);
            $image = FileHelper::uploadFile($data['image'], 'userImage');
        }
        return $this->update($user->id, [
            'name' => $data['name'],
            'email' => $data['email'],
            'user_name' => $data['username'],
            'phone' => $data['phone'],
            'image' => $image ?? $user->image,
            'street' => $data['street'],
            'city' => $data['city'],
            'country' => $data['country'],
        ]);
    }
}
