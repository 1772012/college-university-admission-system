<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'  => 'Matematika'
            ],
            [
                'name'  => 'Bahasa Indonesia'
            ],
            [
                'name'  => 'Bahasa Inggris'
            ],
            [
                'name'  => 'Fisika'
            ],
            [
                'name'  => 'Kimia'
            ],
            [
                'name'  => 'Biologi'
            ],
            [
                'name'  => 'Ekonomi'
            ],
            [
                'name'  => 'Geografi'
            ],
            [
                'name'  => 'Sosiologi'
            ],
            [
                'name'  => 'Bahasa Mandarin'
            ],
            [
                'name'  => 'Bahasa Jepang'
            ],
            [
                'name'  => 'Bahasa Korea'
            ],
            [
                'name'  => 'Bahasa Jerman'
            ],
        ];

        foreach ($data as $item) {
            Subject::updateOrCreate(
                [
                    'name'  => $item['name']
                ],
                $item
            );
        }
    }
}
