<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class StudyProgramController extends Controller
{
    /**
     *  Index
     *
     */
    public function index(): View
    {
        return view('pages.study-programs.index');
    }

    /**
     *  Datatables
     *
     *  @return JsonResponse
     */
    public function datatables(): JsonResponse
    {
        //  Get study programs query
        $studyPrograms = StudyProgram::query()
            ->with('faculty');

        //  Datatable
        $datatable = DataTables::of($studyPrograms);

        //  Code
        $datatable->addColumn('order', function ($model) {
            return view('pages.study-programs.datatables.order', [
                'model' => $model,
            ]);
        });

        //  Alias
        $datatable->addColumn('alias', function ($model) {
            return view('pages.study-programs.datatables.alias', [
                'model' => $model,
            ]);
        });

        //  Faculty
        $datatable->addColumn('faculty', function ($model) {
            return view('pages.study-programs.datatables.faculty', [
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
     *  @param Faculty $faculty
     *  @return JsonResponse
     */
    public function fetch(Faculty $faculty): JsonResponse
    {
        //  Fetch study programs
        $studyPrograms = StudyProgram::where('faculties_id', $faculty->id)
            ->get();

        //  Return response
        if (!$studyPrograms->isNotEmpty()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Study programs data not found.',
                'status'    => 200
            ]);
        } else {
            return response()->json([
                'success'   => true,
                'message'   => 'Successfully retrieve all study programs data.',
                'status'    => 200,
                'data'      => $studyPrograms
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

        //  Find study program
        $studyProgram = StudyProgram::find($request->input('id'));

        //  Return response
        if ($studyProgram) {
            return response()->json([
                'success'   => true,
                'message'   => 'Study program found.',
                'status'    => 200,
                'data'      => $studyProgram
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Study program not found.',
                'status'    => 200
            ]);
        }
    }
}
