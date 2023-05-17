<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
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
                'order' => 1,
                'name'  => 'Kedokteran',
                'code'  => 'FK'
            ],
            [
                'order' => 2,
                'name' => 'Teknik',
                'code' => 'FT'
            ],
            [
                'order' => 3,
                'name' => 'Psikologi',
                'code' => 'FPSI'
            ],
            [
                'order' => 4,
                'name' => 'Bahasa dan Budaya',
                'code' => 'FBB'
            ],
            [
                'order' => 5,
                'name' => 'Bisnis',
                'code' => 'FB'
            ],
            [
                'order' => 6,
                'name' => 'Seni Rupa dan Desain',
                'code' => 'FSRD'
            ],
            [
                'order' => 7,
                'name' => 'Teknologi Informasi',
                'code' => 'FIT'
            ],
            [
                'order' => 8,
                'name' => 'Hukum',
                'code' => 'FH'
            ],
            [
                'order' => 9,
                'name' => 'Kedokteran Gigi',
                'code' => 'FKG'
            ],
        ];

        foreach ($data as $item) {
            Faculty::updateOrCreate(
                [
                    'order' => $item['order'],
                    'name'  => $item['name'],
                    'code'  => $item['code'],
                ],
                $item
            );
        }
    }
}
