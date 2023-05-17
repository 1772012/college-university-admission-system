<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ApplicationController extends Controller
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
        return view('pages.applications.index');
    }

    /**
     *  Create
     *
     *  @param User $user
     *  @return View
     */
    public function create(User $user): View
    {
        return view('pages.applications.create', [
            'user'  => $user,
            'model' => new Application()
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
        //  Get application query
        $applicationQuery = Application::query()
            ->with('user.userDetail', 'applicationStudyPrograms.studyProgram');

        //  Datatable
        $datatable = DataTables::of($applicationQuery);

        //  Created at
        $datatable->addColumn('created-at', function ($model) {
            return view('pages.applications.datatables.created-at', [
                'model' => $model,
            ]);
        });

        //  NRP
        $datatable->addColumn('nrp', function ($model) {
            return view('pages.applications.datatables.nrp', [
                'model' => $model,
            ]);
        });

        //  User detail name
        $datatable->addColumn('name', function ($model) {
            return view('pages.applications.datatables.name', [
                'model' => $model,
            ]);
        });

        //  Application study program
        $datatable->addColumn('application-study-program', function ($model) {
            return view('pages.applications.datatables.application-study-program', [
                'model' => $model,
            ]);
        });

        //  Status
        $datatable->addColumn('status', function ($model) {
            return view('pages.applications.datatables.status', [
                'model' => $model,
            ]);
        });

        //  Action
        $datatable->addColumn('action', function ($model) {
            return view('pages.applications.datatables.action', [
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
     *  @param User $user
     *  @return JsonResponse
     */
    public function fetch(User $user): JsonResponse
    {
        //  Fetch applications
        $applications = Application::with(['applicationStudyPrograms.studyProgram.faculty', 'user.userDetail'])
            ->where('users_id', $user->id)
            ->get();

        //  Return response
        if ($applications->isNotEmpty()) {
            return response()->json([
                'success'   => true,
                'message'   => 'Successfully retrieve all applications data.',
                'status'    => 200,
                'data'      => $applications
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'No applications data found.',
                'status'    => 200
            ]);
        }
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
        //  Search application by nrp or user id
        if ($request->input('nrp')) {
            $applicationData = Application::with(['applicationStudyPrograms.studyProgram.faculty', 'user.userDetail'])
                ->where('nrp', $request->input('nrp'))
                ->first();
        } else {
            $applicationData = Application::with(['applicationStudyPrograms.studyProgram.faculty', 'user.userDetail'])
                ->where('users_id', $user->id)
                ->get();
        }

        //  Return response
        if ($applicationData->isNotEmpty()) {
            return response()->json([
                'success'   => true,
                'message'   => 'Application(s) found.',
                'status'    => 200,
                'data'      => $applicationData
            ]);
        } else {
            return response()->json([
                'success'   => true,
                'message'   => 'No application(s) data found.',
                'status'    => 200
            ]);
        }
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

            //  Create application
            $application = Application::create([
                'users_id'      => $user->id,
                'nrp'           => $this->createNRP($request)
            ]);

            //  Find study program
            $studyProgram = StudyProgram::where('code', $request->input('study_program_code'))->first();

            //  Create application study program
            $application->applicationStudyPrograms()->create([
                'study_programs_id' => $studyProgram->id,
                'is_accepted'       => false,
                'is_processed'      => false,
            ]);

            //  Return response
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'Application has been created.',
                'status'    => 200,
                'data'      => $application
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
     *  @param Application $application
     *  @return JsonResponse
     */
    public function destroy(Application $application): JsonResponse
    {
        DB::beginTransaction();
        try {

            //  Delete application
            $application->delete();

            //  Return response
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'Application has been deleted.',
                'status'    => 200,
                'data'      => $application
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
     *  Create NRP
     *
     *  @param Request $request
     *  @return string
     */
    private function createNRP(Request $request): string
    {
        //  Create year
        $year = date('y', strtotime(now()));
        //  Create study program code
        $studyProgramCode = $request->input('study_program_code');
        //  Get last NRP digit
        $lastNRPDigit = Application::where('nrp', 'like', $year . $studyProgramCode . '%')->max('nrp');
        //  Get digit
        if ($lastNRPDigit) {
            $digit = ((int) substr($lastNRPDigit, -3)) + 1;
        } else {
            $digit = 1;
        }

        return $year . $studyProgramCode . substr('000' . $digit, -3);
    }
}
