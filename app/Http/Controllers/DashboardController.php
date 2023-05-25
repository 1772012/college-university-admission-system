<?php

namespace App\Http\Controllers;

use App\Traits\DBTransactionTrait;
use App\Traits\RedirectTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
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
            return view('pages.dashboard.index');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Service Controllers
    |--------------------------------------------------------------------------
    */

    /**
     *  Chart study program applications
     *
     *  @return JsonResponse
     */
    public function chartStudyProgramApplications(): JsonResponse
    {
        $result = DB::table('application_study_programs')
            ->join('study_programs', 'study_programs.id', '=', 'application_study_programs.study_programs_id')
            ->select(
                'study_programs.name AS study_program_name',
                DB::raw('COUNT(application_study_programs.id) as total_applications')
            )
            ->groupBy('study_program_name')
            ->orderBy('study_program_name', 'DESC')->get();

        return response()->json($result);
    }

    /**
     *  Chart accepted study program
     *
     *  @return JsonResponse
     */
    public function chartAcceptedStudyPrograms(): JsonResponse
    {
        $result = DB::table('application_study_programs')
            ->select(
                'is_accepted AS type',
                DB::raw('COUNT(id) as total_applications')
            )
            ->where('is_accepted', '!=', null) // Exclude NULL values
            ->groupBy('type')
            ->orderBy('type', 'DESC')
            ->get();

        return response()->json($result);
    }
}
