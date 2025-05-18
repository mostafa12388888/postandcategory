<?php

namespace App\Http\Controllers\API\Auth;

use App\Enum\HttpStatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\API\Auth\LoginResource;
use App\Http\Resources\Api\UserResource;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected LoginService $loginService;

    /**
     * __construct
     *
     * @param  mixed $loginService
     * @return void
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {



        if (!$this->loginService->authenticate($request->only('email', 'password'))) {

            return $this->response(new LoginResource([
                'token' => null,
                'user' => null,
                'message' => 'بيانات الدخول غير صحيحة.'
            ]), HttpStatusCodeEnum::UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('API Token')->plainTextToken;
        return $this->response(new LoginResource([
            'token' => $token,
            'user' => $user,
            'message' => 'تم تسجيل الدخول بنجاح.'
        ]), HttpStatusCodeEnum::OK);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'تم تسجيل الخروج.']);
    }
}
