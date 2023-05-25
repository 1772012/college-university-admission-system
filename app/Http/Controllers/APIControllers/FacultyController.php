<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Services\Logics\FacultyService;
use App\Traits\DBTransactionTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FacultyController extends Controller
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

            //  Fetch faculties
            $faculties = FacultyService::fetchFaculties();

            //  Whether faculties is not exists
            if (sizeof($faculties) == 0) {
                return $this->responseError('Faculties data not found.', 400);
            }

            //  Return success response
            return $this->responseSuccess($faculties, 'Successfully retrieve all faculties data.');
        });
    }

    /**
     *  Search
     *
     *  @param Request $request
     *  @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        return $this->wrapTransaction(function () use ($request) {

            //  Get validator
            $validator = FacultyService::validateFacultySearchRequest($request);

            //  Whether user search request is not valid
            if ($validator->fails()) {
                return $this->responseError($validator->errors(), 422);
            }

            //  Get faculty
            $faculty = FacultyService::searchFaculty($request);

            //  Whether faculty is not exists
            if (!$faculty) {
                return $this->responseError('Faculty data not found.', 400);
            }

            //  Return response success
            return $this->responseSuccess($faculty, 'Faculty found.');
        });
    }
}
