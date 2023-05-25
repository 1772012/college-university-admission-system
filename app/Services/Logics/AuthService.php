<?php

namespace App\Services\Logics;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    /**
     *  Auth login
     *
     *  @param Request $request
     *  @return array
     */
    public static function authLogin(Request $request): array
    {
        //  Validate requests
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|string|min:6',
        ]);

        //  Check if validator fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //  Attempt
        $token = auth()->guard('api')->attempt($validator->validated());
        if ($token === false) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        //  Return user token
        return self::createNewToken($token);
    }

    /**
     *  Auth logout
     *
     *  @return void
     */
    public static function authLogout(): void
    {
        auth()->guard('api')->logout();
    }

    /**
     *  Auth get user data
     *
     *  @return User
     */
    public static function authUserProfile(): User
    {
        return auth()->guard('api')->user();
    }

    /**
     *  Validate user login request
     *
     *  @param Request $request
     */
    public static function validateAuthLoginRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|string|min:6',
        ]);
    }

    /**
     *  Get the token array structure.
     *
     *  @param  string $token
     *  @return array
     */
    private static function createNewToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->guard('api')->user()
        ];
    }
}
