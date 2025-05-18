<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\dashboard\UserUpdateRequest;
use App\Models\User;
use App\Services\Frontend\SettingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{

    /**
     * service
     *
     * @var SettingServices
     */
    protected SettingServices $service;
    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct(SettingServices $service)
    {
        $this->service = $service;
    }
    /**
     * getSetting
     *
     * @return void
     */
    public function getSetting()
    {
        return view('frontEnd.dashboard.setting');
    }
    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(UserUpdateRequest $request)
    {

        $this->service->settingUpdate($request->all());

        Session::flash('success', 'your update is success');
        return redirect()->back();
    }
}
