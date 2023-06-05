<?php

namespace App\Services\Logics;

use App\Models\User;
use App\Traits\DatatableTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserService
{
    use DatatableTrait;

    /**
     *  Fetch users
     *
     *  @return array
     */
    public static function fetchUsers(): array
    {
        //  Fetch users
        $users = User::query()
            ->with(['userDetail', 'applications.applicationStudyPrograms.studyProgram.faculty'])
            ->where('role', 'user')
            ->get();

        //  Return users
        return $users->toArray();
    }

    /**
     *  Search user
     *
     *  @param Request $request
     *  @return array
     */
    public static function searchUser(Request $request): array
    {
        return User::query()
            ->with(['userDetail', 'applications.applicationStudyPrograms.studyProgram.faculty'])
            ->find($request->input('id'))
            ->toArray();
    }

    /**
     *  User datatables
     *
     *  @return JsonResponse
     */
    public static function userDatatables(): JsonResponse
    {
        //  Datatable
        $datatable = DataTables::of(User::queryWithoutAdmins());

        //  Created at
        self::generateColumn($datatable, 'created-at', 'pages.users.datatables');

        //  User detail name
        self::generateColumn($datatable, 'name', 'pages.users.datatables');

        //  Email
        self::generateColumn($datatable, 'email', 'pages.users.datatables');

        //  Action
        self::generateColumn($datatable, 'action', 'pages.users.datatables');

        return $datatable
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     *  Insert user
     *
     *  @param Request $request
     *  @return array
     */
    public static function insertUser(Request $request): array
    {
        //  Create user
        $user = User::create([
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
            'role'      => 'user'
        ]);

        //  Create user detail
        $user->userDetail()->create([
            'name'      => $request->input('name')
        ]);

        //  Create notification
        $user->notifications()->create([
            'description'   => 'Anda telah membuat akun.',
            'is_read'       => false
        ]);

        //  Return user
        return $user->toArray();
    }

    /**
     *  Update user
     *
     *  @param Request $request
     *  @param User $user
     *  @return array
     */
    public static function updateUser(Request $request, User $user): array
    {
        //  Update user
        $user->update([
            'email' => $request->input('email'),
        ]);

        //  Update user detail
        $user->userDetail->update([
            'name'  => $request->input('name')
        ]);

        //  Create notification
        $user->notifications()->create([
            'description'   => 'Anda telah mengubah akun.',
            'is_read'       => false
        ]);

        //  Return user
        return $user->toArray();
    }

    /**
     *  Delete user
     *
     *  @param User $user
     *  @return array
     */
    public static function deleteUser(User $user): array
    {
        //  Delete user
        $user->delete();

        //  Return user
        return $user->toArray();
    }

    /**
     *  Validate user search request
     *
     *  @param Request $request
     */
    public static function validateUserSearchRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'id'    => 'required|uuid',
        ]);
    }

    /**
     *  Validate user store request
     *
     *  @param Request $request
     */
    public static function validateUserStoreRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|max:300',
            'name'      => 'required|max:300',
        ]);
    }

    /**
     *  Validate user update request
     *
     *  @param Request $request
     */
    public static function validateUserUpdateRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'email'     => 'required|email|unique:users,email',
            'name'      => 'required|max:300',
        ]);
    }
}
