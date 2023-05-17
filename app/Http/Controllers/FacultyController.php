<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class FacultyController extends Controller
{
    /**
     *  Index
     *
     */
    public function index(): View
    {
        return view('pages.faculties.index');
    }

    /**
     *  Datatables
     *
     *  @return JsonResponse
     */
    public function datatables(): JsonResponse
    {
        //  Get faculty query
        $facultyQuery = Faculty::query();

        //  Datatable
        $datatable = DataTables::of($facultyQuery);

        //  Order
        $datatable->addColumn('order', function ($model) {
            return view('pages.faculties.datatables.order', [
                'model' => $model,
            ]);
        });

        //  Code
        $datatable->addColumn('code', function ($model) {
            return view('pages.faculties.datatables.code', [
                'model' => $model,
            ]);
        });

        //  Name
        $datatable->addColumn('name', function ($model) {
            return view('pages.faculties.datatables.name', [
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
     *  @return JsonResponse
     */
    public function fetch(): JsonResponse
    {
        //  Fetch faculties
        $faculties = Faculty::with('studyPrograms')
            ->get();

        //  Return response
        if (!$faculties->isNotEmpty()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Faculties data not found.',
                'status'    => 200
            ]);
        } else {
            return response()->json([
                'success'   => true,
                'message'   => 'Successfully retrieve all faculties data.',
                'status'    => 200,
                'data'      => $faculties
            ]);
        }
    }

    /**
     *  Search
     *
     *  @param Request $request
     *  @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        //  Check if the request has id
        if (!$request->input('id')) {
            return response()->json([
                'success'   => false,
                'message'   => 'Please provide ID.',
                'status'    => 400
            ]);
        }

        //  Find faculty
        $faculty = Faculty::with('studyPrograms')
            ->find($request->input('id'));

        //  Return response
        if ($faculty) {
            return response()->json([
                'success'   => true,
                'message'   => 'Faculty found.',
                'status'    => 200,
                'data'      => $faculty
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Faculty not found.',
                'status'    => 200
            ]);
        }
    }
}
