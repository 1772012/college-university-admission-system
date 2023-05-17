<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
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
        return view('pages.users.index');
    }

    /**
     *  Create
     *
     *  @return View
     */
    public function create(): View
    {
        return view('pages.users.create.index', [
            'model' => new User()
        ]);
    }

    /**
     *  Edit
     *
     *  @param User $user
     *  @return View
     */
    public function edit(User $user): View
    {
        return view('pages.users.edit.index', [
            'model' => $user
        ]);
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
        //  Get user query
        $userQuery = User::query()
            ->with('userDetail')
            ->select('users.*')
            ->where('role', 'user');

        //  Datatable
        $datatable = DataTables::of($userQuery);

        //  Created at
        $datatable->addColumn('created-at', function ($model) {
            return view('pages.users.datatables.created-at', [
                'model' => $model,
            ]);
        });

        //  User detail name
        $datatable->addColumn('name', function ($model) {
            return view('pages.users.datatables.name', [
                'model' => $model,
            ]);
        });

        //  Email
        $datatable->addColumn('email', function ($model) {
            return view('pages.users.datatables.email', [
                'model' => $model,
            ]);
        });

        //  Action
        $datatable->addColumn('action', function ($model) {
            return view('pages.users.datatables.action', [
                'model' => $model,
            ]);
        });

        return $datatable
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     *  Fetch
     *
     *  @return JsonResponse
     */
    public function fetch(): JsonResponse
    {
        //  Fetch users
        $users = User::with(['userDetail', 'applications.applicationStudyPrograms.studyProgram.faculty'])
            ->get();

        //  Return response
        if (!$users->isNotEmpty()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Users data not found.',
                'status'    => 200
            ]);
        } else {
            return response()->json([
                'success'   => true,
                'message'   => 'Successfully retrieve all users data.',
                'status'    => 200,
                'data'      => $users
            ]);
        }
    }

    /**
     *  Search
     *
     *  @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        //  Check if the request has NRP
        if (!$request->input('id')) {
            return response()->json([
                'success'   => false,
                'message'   => 'Please provide ID.',
                'status'    => 400
            ]);
        }

        //  Find user
        $user = User::with(['userDetail', 'applications.applicationStudyPrograms.studyProgram.faculty'])
            ->find($request->input('id'));

        //  Return response
        if ($user) {
            return response()->json([
                'success'   => true,
                'message'   => 'User found.',
                'status'    => 200,
                'data'      => $user
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'User not found.',
                'status'    => 200
            ]);
        }
    }

    /**
     *  Store
     *
     *  @param Request $request
     *  @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            //  Check if the request has email
            if (!$request->input('email')) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'Please provide email.',
                    'status'    => 400
                ]);
            }

            //  Check if the request has password
            if (!$request->input('password')) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'Please provide password.',
                    'status'    => 400
                ]);
            }

            //  Check if the request has name
            if (!$request->input('name')) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'Please provide name.',
                    'status'    => 400
                ]);
            }

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

            //  Return response
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'User has been created',
                'status'    => 200,
                'data'      => $user
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   => $th->getMessage(),
                'status'    => 500,
                'data'      => null
            ]);
        }
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
        DB::beginTransaction();
        try {

            //  Check if the request has email
            if (!$request->input('email')) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'Please provide email.',
                    'status'    => 400
                ]);
            }

            //  Check if the request has name
            if (!$request->input('name')) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'Please provide password.',
                    'status'    => 400
                ]);
            }

            //  Update user
            $user->update([
                'email' => $request->input('email'),
            ]);

            //  Update user detail
            $user->userDetail->update([
                'name'  => $request->input('name')
            ]);

            //  Return response
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'User has been updated.',
                'status'    => 200,
                'data'      => $user
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   => $th->getMessage(),
                'status'    => 500,
                'data'      => null
            ]);
        }
    }

    /**
     *  Destroy
     *
     *  @param User $user
     *  @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        DB::beginTransaction();
        try {

            //  Delete user
            $user->delete();

            //  Return response
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'User has been deleted.',
                'status'    => 200,
                'data'      => $user
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   => $th->getMessage(),
                'status'    => 500,
                'data'      => null
            ]);
        }
    }
}
