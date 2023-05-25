<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Services\Logics\AuthService;
use App\Traits\DBTransactionTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use DBTransactionTrait, ResponseTrait;

    /**
     *  Login
     *
     *  @param Request $request
     *  @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        return $this->wrapTransaction(function () use ($request) {

            //  Get validator
            $validator = AuthService::validateAuthLoginRequest($request);

            //  Whether user search request is not valid
            if ($validator->fails()) {
                return $this->responseError($validator->errors(), 422);
            }

            //  Return success response
            return $this->responseSuccess(AuthService::authLogin($request), 'User successfully login.');
        });
    }

    /**
     *  Logout
     *
     *  @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->wrapTransaction(function () {
            return $this->responseSuccess(AuthService::authLogout(), 'User successfully logout.');
        });
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function userProfile(): JsonResponse
    {
        return $this->wrapTransaction(function () {
            return $this->responseSuccess(AuthService::authUserProfile(), 'Successfully get user data.');
        });
    }
}
