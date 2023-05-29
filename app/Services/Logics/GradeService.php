<?php

namespace App\Services\Logics;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class GradeService
{
    /**
     *  Fetch grades
     *
     *  @param User $user
     *  @return array
     */
    public static function fetchGrades(User $user): array
    {
        return $user->grades()->with('subject')->get()->toArray();
    }

    /**
     *  Insert grades
     *
     *  @param Request $request,
     *  @param User $user
     *  @return array
     */
    public static function insertGrades(Request $request, User $user): array
    {
        //  Access all request data
        foreach ($request->input('data') as $data) {

            //  Get subject
            $subject = Subject::where('name', $data['subject_name'])->first();

            //  Update or create grade
            Grade::updateOrCreate(
                [
                    'subjects_id' => $subject->id,
                    'users_id' => $user->id,
                    'semester' => $data['semester']
                ],
                [
                    'subjects_id' => $subject->id,
                    'users_id' => $user->id,
                    'kkm' => $data['kkm'],
                    'value' => $data['value'],
                    'semester' => $data['semester']
                ]
            );
        }

        //  Return user grades
        return self::fetchGrades($user);
    }
}
