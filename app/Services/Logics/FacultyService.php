<?php

namespace App\Services\Logics;

use App\Models\Faculty;
use App\Traits\DatatableTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FacultyService
{
    use DatatableTrait;

    /**
     *  Fetch faculties
     *
     *  @return array
     */
    public static function fetchFaculties(): array
    {
        return Faculty::query()
            ->with('studyPrograms')
            ->get()
            ->toArray();
    }

    /**
     *  Search faculty
     *
     *  @param Request $request
     *  @return array
     */
    public static function searchFaculty(Request $request): array
    {
        return Faculty::query()
            ->with('studyPrograms')
            ->find($request->input('id'))
            ->toArray();
    }

    /**
     *  Faculty datatables
     *
     *  @return JsonResponse
     */
    public static function facultyDatatables(): JsonResponse
    {
        //  Datatable
        $datatable = DataTables::of(Faculty::query()->select('faculties.*'));

        //  Order
        self::generateColumn($datatable, 'order', 'pages.faculties.datatables');

        //  Code
        self::generateColumn($datatable, 'code', 'pages.faculties.datatables');

        //  Name
        self::generateColumn($datatable, 'name', 'pages.faculties.datatables');

        return $datatable
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     *  Validate faculty search request
     *
     *  @param Request $request
     */
    public static function validateFacultySearchRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'id'    => 'required|uuid',
        ]);
    }
}
