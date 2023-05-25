<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\Logics\UserService;
use App\Traits\DBTransactionTrait;
use App\Traits\RedirectTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    use RedirectTrait, DBTransactionTrait, ResponseTrait;

    /*
    |--------------------------------------------------------------------------
    | View Controllers
    |--------------------------------------------------------------------------
    */

    /**
     *  Index
     *
     *  @return View
     */
    public function index(): View
    {
        return $this->renderOrRedirect(function () {
            return view('pages.users.index');
        });
    }

    /**
     *  Create
     *
     *  @return View
     */
    public function create(): View
    {
        return $this->renderOrRedirect(function () {
            return view('pages.users.create.index', ['model' => new User()]);
        });
    }

    /**
     *  Edit
     *
     *  @param User $user
     *  @return View
     */
    public function edit(User $user): View
    {
        return $this->renderOrRedirect(function () use ($user) {
            return view('pages.users.edit.index', ['model' => $user]);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Service Controllers
    |--------------------------------------------------------------------------
    */

    /**
     *  Datatables
     *
     *  @return JsonResponse
     */
    public function datatables(): JsonResponse
    {
        return UserService::userDatatables();
    }

    /**
     *  Store
     *
     *  @param UserStoreRequest $request
     *  @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        return $this->wrapTransaction(function () use ($request) {
            //  Insert user
            $user = UserService::insertUser($request);

            //  Return success response
            return $this->responseSuccess($user, 'Akun pendaftar berhasil dibuat.');
        });
    }

    /**
     *  Update
     *
     *  @param UserUpdateRequest $request
     *  @param User $user
     *  @return JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        return $this->wrapTransaction(function () use ($request, $user) {
            //  Update user
            $user = UserService::updateUser($request, $user);

            //  Return success response
            return $this->responseSuccess($user, 'Akun pendaftar berhasil diubah.');
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
            //  Delete user
            $user = UserService::deleteUser($user);
            //  Return success response
            return $this->responseSuccess($user, 'Akun pendaftar berhasil dihapus.');
        });
    }
}
