<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use App\Services\Logics\GradeService;
use App\Traits\DBTransactionTrait;
use App\Traits\RedirectTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GradeController extends Controller
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
     *  @param User $user
     *  @return View
     */
    public function index(User $user): View
    {
        return $this->renderOrRedirect(function () use ($user) {

            //  Fetch all subjects
            $subjects = Subject::all();

            //  Return view
            return view('pages.grades.index', [
                'user'      => $user,
                'subjects'  => $subjects,
                'grades'    => $user->grades
            ]);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Service Controllers
    |--------------------------------------------------------------------------
    */

    /**
     *  Store
     *
     *  @param Request $request
     *  @param User $user
     *  @return JsonResponse
     */
    public function store(Request $request, User $user): JsonResponse
    {
        return $this->wrapTransaction(function () use ($request, $user) {

            //  Create grades
            $grades = GradeService::insertGrades($request, $user);

            //  Return success response
            return $this->responseSuccess($grades, 'Berhasil membuat nilai rapor.');
        });
    }
}
