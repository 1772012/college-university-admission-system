<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Services\Logics\StudyProgramService;
use App\Traits\DBTransactionTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    use DBTransactionTrait, ResponseTrait;

    /**
     *  Fetch
     *
     *  @param Faculty $faculty
     *  @return JsonResponse
     */
    public function fetch(Faculty $faculty): JsonResponse
    {
        return $this->wrapTransaction(function () use ($faculty) {

            //  Fetch study program
            $studyPrograms = StudyProgramService::fetchStudyPrograms($faculty);

            //  Whether study programs is not exists
            if (sizeof($studyPrograms) == 0) {
                return $this->responseError('Study programs data not found.', 400);
            }

            //  Return success response
            return $this->responseSuccess($studyPrograms, 'Successfully retrieve all study programs data.');
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
            $validator = StudyProgramService::validateStudyProgramSearchRequest($request);

            //  Whether study program search request is not valid
            if ($validator->fails()) {
                return $this->responseError($validator->errors(), 422);
            }

            //  Search study program
            $studyProgram = StudyProgramService::searchStudyProgram($request);

            //  Whether study program is not exists
            if (!$studyProgram) {
                return $this->responseError('Study program not found.', 400);
            }

            //  Return success response
            return $this->responseSuccess($studyProgram, 'Study program found.');
        });
    }
}
