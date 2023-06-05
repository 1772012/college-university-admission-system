<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationResultMail;
use App\Models\Application;
use App\Models\Faculty;
use App\Models\StudyProgram;
use App\Models\User;
use App\Services\Logics\ApplicationService;
use App\Traits\DBTransactionTrait;
use App\Traits\RedirectTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ApplicationController extends Controller
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
            return view('pages.applications.index');
        });
    }

    /**
     *  Create
     *
     *  @param User $user
     *  @return View
     */
    public function create(User $user): View
    {
        return $this->renderOrRedirect(function () use ($user) {
            return view('pages.applications.create.index', [
                'user'      => $user,
                'model'     => new Application(),
                'faculties' => Faculty::all()->pluck('name', 'id')
            ]);
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
        return ApplicationService::applicationDatatables();
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

            //  Create application
            $application = ApplicationService::insertApplication($request, $user);

            //  Return success response
            return $this->responseSuccess($application, 'Berhasil membuat pendaftaran.');
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

            //  Create application
            $application = ApplicationService::deleteApplication($application);

            //  Return success response
            return $this->responseSuccess($application, 'Berhasil menghapus pendaftaran.');
        });
    }

    /**
     *  Get study programs
     *
     *  @param Request $request
     *  @return JsonResponse
     */
    public function getStudyPrograms(Request $request): JsonResponse
    {
        //  Get study programs
        $result = StudyProgram::query()
            ->where('faculties_id', $request->input('faculty_id'))
            ->get()
            ->pluck('name', 'code');

        //  Return response
        return response()->json($result);
    }

    /**
     *  Mail
     *
     *  @param Application $application
     *  @return JsonResponse
     */
    public function mail(Application $application): JsonResponse
    {
        return $this->wrapTransaction(function () use ($application) {

            //  Mail to application
            try {
                Mail::to($application->user->email)->send(new ApplicationResultMail([
                    'user_name'     => $application->user->userDetail->name,
                    'user_nrp'      => $application->nrp,
                    'is_accepted'   => $application->applicationStudyPrograms->first()->is_accepted
                ], 'Info Rekomendasi Program Studi'));
            } catch (\Throwable $th) {
                return $this->responseError($th->getMessage());
            }

            //  Return success response
            return $this->responseSuccess($application, 'Berhasil mengirim email.');
        });
    }

    /**
     *  Predict
     *
     *  @param Application $application
     *  @return JsonResponse
     */
    public function predict(Application $application): JsonResponse
    {
        return $this->wrapTransaction(function () use ($application) {

            //  Predict
            //  TODO

            //  Update application's study program
            $application->applicationStudyPrograms->first()->update([
                'is_processed'  => true
            ]);

            //  Return success response
            return $this->responseSuccess($application, 'Berhasil memproses rekomendasi.');
        });
    }
}
