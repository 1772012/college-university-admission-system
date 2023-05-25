<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use App\Services\Logics\ApplicationService;
use App\Traits\DBTransactionTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
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

            //  Fetch applications
            $applications = ApplicationService::fetchApplications($user);

            //  Whether applications is not exists
            if (sizeof($applications) == 0) {
                return $this->responseError('No applications data found.', 400);
            }

            //  Return success response
            return $this->responseSuccess($applications, 'Successfully retrieve all applications data.');
        });
    }

    /**
     *  Search
     *
     *  @param Request $request
     *  @param User $user
     *  @return JsonResponse
     */
    public function search(Request $request, User $user): JsonResponse
    {
        return $this->wrapTransaction(function () use ($request, $user) {
            //  Whether nrp requests is not null
            if ($request->input('nrp')) {

                //  Search application
                $applicationData = ApplicationService::searchApplicationByNRP($request);

                //  Whether application is not exists
                if ($applicationData) {
                    return $this->responseError('No application data found.', 400);
                }

                //  Return success response
                return $this->responseSuccess($applicationData, 'Successfully retrieve all application data.');
            } else {

                //  Search applications
                $applicationData = ApplicationService::searchApplicationByUser($user);

                //  Whether applications is not exists
                if ($applicationData) {
                    return $this->responseError('No applications data found.', 400);
                }

                //  Return success response
                return $this->responseSuccess($applicationData, 'Successfully retrieve all applications data.');
            }
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
            //  Get validator
            $validator = ApplicationService::validateApplicationStoreRequest($request);

            //  Whether user store request is not valid
            if ($validator->fails()) {
                return $this->responseError($validator->errors(), 422);
            }

            //  Return response success
            return $this->responseSuccess(ApplicationService::insertApplication($request, $user), 'Application has been created.');
        });
    }

    /**
     *  Destroy
     *
     *  @param Application $application
     *  @return JsonResponse
     */
    public function destroy(Application $application): JsonResponse
    {
        return $this->wrapTransaction(function () use ($application) {
            return $this->responseSuccess(ApplicationService::deleteApplication($application), 'Application has been deleted.');
        });
    }
}
