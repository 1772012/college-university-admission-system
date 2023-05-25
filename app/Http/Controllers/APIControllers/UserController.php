<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Logics\UserService;
use App\Traits\DBTransactionTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use DBTransactionTrait, ResponseTrait;

    /**
     *  Fetch
     *
     *  @return JsonResponse
     */
    public function fetch(): JsonResponse
    {
        return $this->wrapTransaction(function () {
            return $this->responseSuccess(UserService::fetchUsers(), 'Successfully get users data');
        });
    }

    /**
     *  Search
     *
     *  @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        return $this->wrapTransaction(function () use ($request) {

            //  Get validator
            $validator = UserService::validateUserSearchRequest($request);

            //  Whether user search request is not valid
            if ($validator->fails()) {
                return $this->responseError($validator->errors(), 422);
            }

            //  Return response success
            return $this->responseSuccess(UserService::searchUser($request), 'Successfully get user data');
        });
    }

    /**
     *  Store
     *
     *  @param Request $request
     *  @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->wrapTransaction(function () use ($request) {

            //  Get validator
            $validator = UserService::validateUserStoreRequest($request);

            //  Whether user store request is not valid
            if ($validator->fails()) {
                return $this->responseError($validator->errors(), 422);
            }

            //  Return response success
            return $this->responseSuccess(UserService::insertUser($request), 'User has been created.');
        });
    }

    /**
     *  Update
     *
     *  @param Request $request
     *  @param User $user
     *  @return JsonResponse
     */
    public function update(Request $request, User $user): JsonResponse
    {
        return $this->wrapTransaction(function () use ($request, $user) {

            //  Get validator
            $validator = UserService::validateUserUpdateRequest($request);

            //  Whether user update request is not valid
            if ($validator->fails()) {
                return $this->responseError($validator->errors(), 422);
            }

            //  Return response success
            return $this->responseSuccess(UserService::updateUser($request, $user), 'User has been updated.');
        });
    }

    /**
     *  Destroy
     *
     *  @param User $user
     *  @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        return $this->wrapTransaction(function () use ($user) {
            return $this->responseSuccess(UserService::deleteUser($user), 'User has been deleted.');
        });
    }
}
