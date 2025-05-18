<?php
namespace App\Repository\Frontend;

use App\Models\Setting;
use App\Repository\MainRepository;



class SettingRepository extends MainRepository
{


    /**
     * model
     *
     * @return string
     */
    public function model(): string
    {
        return Setting::class;
    }
    /**
     * index
     *
     * @return mixed
     */
    public function index():mixed
    {
        return $this->model->where('user_id',auth()->user()->id)->with('images')->latest()->get();
    }

}
