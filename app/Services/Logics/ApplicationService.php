<?php

namespace App\Services\Logics;

use App\Models\Application;
use App\Models\StudyProgram;
use App\Models\User;
use App\Traits\DatatableTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ApplicationService
{
    use DatatableTrait;

    /**
     *  Fetch applications
     *
     *  @param User $user
     *  @return array
     */
    public static function fetchApplications(User $user): array
    {
        return Application::query()
            ->with('user.userDetail', 'applicationStudyPrograms.studyProgram.faculty')
            ->where('users_id', $user->id)
            ->get()
            ->toArray();
    }

    /**
     *  Search application by user
     *
     *  @param User $user
     *  @return array
     */
    public static function searchApplicationByUser(User $user): array
    {
        return Application::query()
            ->with('user.userDetail', 'applicationStudyPrograms.studyProgram.faculty')
            ->where('users_id', $user->id)
            ->toArray();
    }

    /**
     *  Application datatables
     *
     *  @return JsonResponse
     */
    public static function applicationDatatables(): JsonResponse
    {
        //  Datatable
        $datatable = DataTables::of(Application::query());

        //  Created at
        self::generateColumn($datatable, 'created-at', 'pages.applications.datatables');

        //  NRP
        self::generateColumn($datatable, 'nrp', 'pages.applications.datatables');

        //  Name
        self::generateColumn($datatable, 'name', 'pages.applications.datatables');

        //  Application study program
        self::generateColumn($datatable, 'application-study-program', 'pages.applications.datatables');

        //  Status
        self::generateColumn($datatable, 'status', 'pages.applications.datatables');

        //  Action
        self::generateColumn($datatable, 'action', 'pages.applications.datatables');

        return $datatable
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     *  Search application by nrp
     *
     *  @param Request $request
     *  @return array
     */
    public static function searchApplicationByNRP(Request $request): array
    {
        return Application::query()
            ->with('user.userDetail', 'applicationStudyPrograms.studyProgram.faculty')
            ->where('nrp', $request->input('nrp'))
            ->first()
            ->toArray();
    }

    /**
     *  Insert application
     *
     *  @param Request $request
     *  @param User $user
     *  @return array
     */
    public static function insertApplication(Request $request, User $user): array
    {
        //  Create application
        $application = Application::create([
            'users_id'      => $user->id,
            'nrp'           => self::createNRP($request)
        ]);

        //  Find study program
        $studyProgram = StudyProgram::query()
            ->where('code', $request->input('study_program_code'))
            ->first();

        //  Create application study program
        $application->applicationStudyPrograms()->create([
            'study_programs_id' => $studyProgram->id,
            'is_processed'      => false,
        ]);

        //  Return application
        return $application->toArray();
    }

    /**
     *  Delete application
     *
     *  @param Application $application
     *  @return array
     */
    public static function deleteApplication(Application $application): array
    {
        //  Delete application
        $application->delete();

        //  Return application
        return $application->toArray();
    }

    /**
     *  Validate application store request
     *
     *  @param Request $request
     */
    public static function validateApplicationStoreRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'study_program_code'    => 'required',
        ]);
    }

    /**
     *  Create NRP
     *
     *  @param Request $request
     *  @return string
     */
    private static function createNRP(Request $request): string
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
