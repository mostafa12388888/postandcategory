<?php

namespace App\Services\Frontend;

use App\Helpers\FileHelper;
use App\Repository\Frontend\SettingRepository;
use App\Repository\MainRepository;
use App\Services\MainService;

class SettingServices extends MainService
{
    /**
     * @var SettingRepository
     */
    protected MainRepository $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     * @return void
     */
    public function __construct(SettingRepository $repository)
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
    public function settingUpdate(array $data): mixed
    {
        return app(UserServices::class)->userUpdate($data);
    }
}
