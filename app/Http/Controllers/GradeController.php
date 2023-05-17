<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GradeController extends Controller
{
    /**
     *  Index
     *
     *  @param User $user
     *  @return View
     */
    public function index(User $user): View
    {
        return view('pages.grades.index', [
            'user'  => $user
        ]);
    }

    /**
     *  Store
     *
     *  @param Request $request
     *  @param User $user
     *  @return JsonResponse
     */
    public function store(Request $request, User $user): JsonResponse
    {
        DB::beginTransaction();
        try {

            //  Create grades

            //  Return response
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => null,
                'status'    => 200,
                'data'      => []
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
     *  @param Grade $Grade
     *  @return JsonResponse
     */
    public function update(Request $request, User $user, Grade $Grade): JsonResponse
    {
        DB::beginTransaction();
        try {

            //  Update Grades

            //  Return response
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => null,
                'status'    => 200,
                'data'      => []
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
     *  @param Grade $Grade
     *  @return JsonResponse
     */
    public function destroy(User $user, Grade $Grade): JsonResponse
    {
        DB::beginTransaction();
        try {

            //  Delete Grades

            //  Return response
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => null,
                'status'    => 200,
                'data'      => []
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
