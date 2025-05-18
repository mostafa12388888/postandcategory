<?php
namespace App\Repository\Frontend;

use App\Models\User;
use App\Repository\MainRepository;



class UserRepository extends MainRepository
{


    /**
     * model
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
