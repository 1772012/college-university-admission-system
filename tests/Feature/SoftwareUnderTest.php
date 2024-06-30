<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class SoftwareUnderTest extends TestCase
{
    public function test_login()
    {
        $response = $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    public function test_login_view_users_page()
    {
        //  Login
        $response = $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

        //  View users page
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    public function test_login_create_user()
    {
        //  Login
        $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

        //  Insert user
        $this->post('users/store', [
            'email'     => 'johnwick@email.com',
            'password'  => '12345678',
            'name'      => 'John Wick'
        ]);

        //  See updated data
        $this->assertDatabaseHas('users', [
            'email' => 'johnwick@email.com'
        ]);
        $this->assertDatabaseHas('user_details', [
            'name' => 'John Wick'
        ]);
    }

    public function test_login_with_nullable_user()
    {
        //  Login
        $response = $this->post('/auth', [
            'email' => 'johnwick@email.com',
            'password' => 'ukm12345*',
        ]);

        // Assert the response status for validation error
        $response->assertStatus(302);
    }

    public function test_login_create_user_with_null_password()
    {
        //  Login
        $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

        //  Insert user
        $response = $this->post('users/store', [
            'email'     => 'johnwick@email.com',
            'password'  => null,
            'name'      => 'John Wick'
        ]);

        // Assert the response status for validation error
        $response->assertStatus(302);
    }

    public function test_login_create_applicant_with_nullable_study_program()
    {
        //  Login
        $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

            //  Insert user
        $this->post('users/store', [
            'email'     => 'johnwick@email.com',
            'password'  => '12345678',
            'name'      => 'John Wick'
        ]);

        //  Get created user
        $users_id = User::where('email', 'johnwick@email.com')->first()->id;

        //  Insert applications
        $response = $this->post("applications/{$users_id}/store", [
            "study_program_code" => 880
        ]);

        // Assert the response status for validation error
        $response->assertStatus(500);
    }

    public function test_login_view_grades_page()
    {
        //  Login
        $response = $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

        //  View grades page
        $users_id = User::where('email', 'johnwick@email.com')->first()->id;
        $response = $this->get("/{$users_id}/grades");
        $response->assertStatus(200);
    }

    public function test_login_create_grades()
    {
        //  Login
        $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

        //  Get created user
        $users_id = User::where('email', 'johnwick@email.com')->first()->id;

        //  Insert grades
        $response = $this->post("{$users_id}/grades/store", [
            'data' => [

                [
                    "subject_name" => "Matematika",
                    "value" => 93,
                    "kkm" => 78,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Matematika",
                    "value" => 73,
                    "kkm" => 0,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Bahasa Inggris",
                    "value" => 80,
                    "kkm" => 57,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Bahasa Inggris",
                    "value" => 47,
                    "kkm" => 77,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Bahasa Indonesia",
                    "value" => 67,
                    "kkm" => 12,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Bahasa Indonesia",
                    "value" => 37,
                    "kkm" => 24,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Fisika",
                    "value" => 96,
                    "kkm" => 91,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Fisika",
                    "value" => 39,
                    "kkm" => 15,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Kimia",
                    "value" => 39,
                    "kkm" => 93,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Kimia",
                    "value" => 41,
                    "kkm" => 38,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Biologi",
                    "value" => 79,
                    "kkm" => 62,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Biologi",
                    "value" => 49,
                    "kkm" => 18,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Geografi",
                    "value" => 31,
                    "kkm" => 5,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Geografi",
                    "value" => 20,
                    "kkm" => 40,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Sosiologi",
                    "value" => 53,
                    "kkm" => 66,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Sosiologi",
                    "value" => 35,
                    "kkm" => 37,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Ekonomi",
                    "value" => 30,
                    "kkm" => 34,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Ekonomi",
                    "value" => 3,
                    "kkm" => 88,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Bahasa Mandarin",
                    "value" => 61,
                    "kkm" => 21,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Bahasa Mandarin",
                    "value" => 83,
                    "kkm" => 63,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Bahasa Jepang",
                    "value" => 49,
                    "kkm" => 74,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Bahasa Jepang",
                    "value" => 61,
                    "kkm" => 70,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Bahasa Korea",
                    "value" => 86,
                    "kkm" => 22,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Bahasa Korea",
                    "value" => 24,
                    "kkm" => 67,
                    "semester" => "Ganjil"
                ],
                [
                    "subject_name" => "Bahasa Jerman",
                    "value" => 3,
                    "kkm" => 2,
                    "semester" => "Genap"
                ],
                [
                    "subject_name" => "Bahasa Jerman",
                    "value" => 100,
                    "kkm" => 36,
                    "semester" => "Ganjil"
                ]
            ]
        ]);

        //  See updated data
        $response->assertJsonStructure([
            'success',
            'message',
            'status',
            'data' => [
                '*' => [
                    'id',
                    'subjects_id',
                    'users_id',
                    'kkm',
                    'value',
                    'semester',
                    'created_at',
                    'updated_at',
                    'subject' => [
                        'id',
                        'name'
                    ]
                ]
            ]
        ]);
    }

    public function test_login_view_new_applicants_page()
    {
        //  Login
        $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

        //  View new applications page
        $users_id = User::where('email', 'johnwick@email.com')->first()->id;
        $response = $this->get("applications/{$users_id}/create");
        $response->assertStatus(200);
    }

    public function test_login_create_applicant()
    {
        //  Login
        $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

        //  Get created user
        $users_id = User::where('email', 'johnwick@email.com')->first()->id;

        //  Insert applications
        $response = $this->post("applications/{$users_id}/store", [
            "study_program_code" => 72
        ]);

        //  See updated data
        $response->assertJsonStructure([
            'success',
            'message',
            'status',
            'data' => [
                'users_id',
                'nrp',
                'id',
                'updated_at',
                'created_at'
            ]
        ]);
    }

    public function test_login_view_applicants_page()
    {
        //  Login
        $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

        //  View applications page
        $response = $this->get("applications");
        $response->assertStatus(200);
    }

    public function test_login_process_applicant()
    {
        //  Login
        $this->post('/auth', [
            'email' => 'super.admin@email.com',
            'password' => 'ukm12345*',
        ]);

        //  Get created user and applicants
        $user = User::where('email', 'johnwick@email.com')->first();
        $applications_id = $user->applications->first()->id;

        //  Process applications
        $response = $this->post("applications/{$applications_id}/predict");

        //  See updated data
        $response->assertJsonStructure([
            'success',
            'message',
            'status',
            'data' => [
                'id',
                'nrp',
                'users_id',
                'created_at',
                'updated_at',
                'application_study_programs' => [
                    '*' => [
                        'id',
                        'applications_id',
                        'study_programs_id',
                        'is_accepted',
                        'is_processed',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ],
        ]);
    }
}
