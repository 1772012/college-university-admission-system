<?php

namespace App\Services\Logics;

use App\Models\Faculty;
use App\Models\StudyProgram;
use App\Traits\DatatableTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StudyProgramService
{
    use DatatableTrait;

    /**
     *  Fetch study programs
     *
     *  @param Faculty $faculty
     */
    public static function fetchStudyPrograms(Faculty $faculty): array
    {
        return StudyProgram::query()
            ->where('faculties_id', $faculty->id)
            ->get()
            ->toArray();
    }

    /**
     *  Search study program
     *
     *  @param Request $request
     *  @return array
     */
    public static function searchStudyProgram(Request $request): array
    {
        return StudyProgram::query()
            ->find($request->input('id'))
            ->toArray();
    }

    /**
     *  Study program datatables
     *
     *  @return JsonResponse
     */
    public static function studyProgramDatatables(): JsonResponse
    {
        //  Datatable
        $datatable = DataTables::of(StudyProgram::query()->with('faculty')->select('study_programs.*'));

        //  Code
        self::generateColumn($datatable, 'code', 'pages.study-programs.datatables');

        //  Alias
        self::generateColumn($datatable, 'alias', 'pages.study-programs.datatables');

        //  Name
        self::generateColumn($datatable, 'name', 'pages.study-programs.datatables');

        //  Faculty
        self::generateColumn($datatable, 'faculty', 'pages.study-programs.datatables');

        return $datatable
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     *  Validate study program search request
     *
     *  @param Request $request
     */
    public static function validateStudyProgramSearchRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'id'    => 'required|uuid',
        ]);
    }
}
