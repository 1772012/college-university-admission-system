<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Logics\GradeService;
use App\Traits\DBTransactionTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    use DBTransactionTrait, ResponseTrait;

    /**
     *  Fetch
     *
     *  @param User $user
     *  @return JsonResponse
     */
    public function fetch(User $user): JsonResponse
    {
        return $this->wrapTransaction(function () use ($user) {
            return $this->responseSuccess(
                GradeService::fetchGrades($user),
                'Grades found.'
            );
        });
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
        return $this->wrapTransaction(function () use ($request, $user) {
            return $this->responseSuccess(
                GradeService::insertGrades($request, $user),
                'Grades successfully created or updated.'
            );
        });
    }
}
