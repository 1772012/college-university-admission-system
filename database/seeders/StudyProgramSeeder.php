<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Kedokteran',                   'code' => '10', 'faculties_id' => Faculty::where('order', 1)->first()->id, 'alias' => 'KDU',    'level' => 'S1'),
            array('name' => 'Profesi Dokter',               'code' => '15', 'faculties_id' => Faculty::where('order', 1)->first()->id, 'alias' => 'PKDU',   'level' => 'PF'),
            array('name' => 'Penuaan Kulit dan Estetika',   'code' => '17', 'faculties_id' => Faculty::where('order', 1)->first()->id, 'alias' => 'MKES',   'level' => 'S2'),
            array('name' => 'Teknik Sipil',                 'code' => '21', 'faculties_id' => Faculty::where('order', 2)->first()->id, 'alias' => 'JTS',    'level' => 'S1'),
            array('name' => 'Teknik Elektro',               'code' => '22', 'faculties_id' => Faculty::where('order', 2)->first()->id, 'alias' => 'JTE',    'level' => 'S1'),
            array('name' => 'Teknik Industri',              'code' => '23', 'faculties_id' => Faculty::where('order', 2)->first()->id, 'alias' => 'JTI',    'level' => 'S1'),
            array('name' => 'Sistem Komputer',              'code' => '27', 'faculties_id' => Faculty::where('order', 2)->first()->id, 'alias' => 'JTK',    'level' => 'S1'),
            array('name' => 'Psikologi',                    'code' => '30', 'faculties_id' => Faculty::where('order', 3)->first()->id, 'alias' => 'PSI',    'level' => 'S1'),
            array('name' => 'Magister Psikologi Profesi',   'code' => '32', 'faculties_id' => Faculty::where('order', 3)->first()->id, 'alias' => 'MPSI',   'level' => 'PF'),
            array('name' => 'Magister Psikologi',           'code' => '34', 'faculties_id' => Faculty::where('order', 3)->first()->id, 'alias' => 'MPSN',   'level' => 'S2'),
            array('name' => 'Sastra Inggris',               'code' => '41', 'faculties_id' => Faculty::where('order', 4)->first()->id, 'alias' => 'SIG',    'level' => 'S1'),
            array('name' => 'Sastra Jepang',                'code' => '42', 'faculties_id' => Faculty::where('order', 4)->first()->id, 'alias' => 'SJP',    'level' => 'S1'),
            array('name' => 'Bahasa Mandarin',              'code' => '44', 'faculties_id' => Faculty::where('order', 4)->first()->id, 'alias' => '3BM',    'level' => 'D3'),
            array('name' => 'Sastra Cina',                  'code' => '46', 'faculties_id' => Faculty::where('order', 4)->first()->id, 'alias' => 'SCH',    'level' => 'S1'),
            array('name' => 'Akuntansi',                    'code' => '51', 'faculties_id' => Faculty::where('order', 5)->first()->id, 'alias' => 'EKA',    'level' => 'S1'),
            array('name' => 'Manajemen',                    'code' => '52', 'faculties_id' => Faculty::where('order', 5)->first()->id, 'alias' => 'EKM',    'level' => 'S1'),
            array('name' => 'Magister Manajemen',           'code' => '53', 'faculties_id' => Faculty::where('order', 5)->first()->id, 'alias' => 'MEKM',   'level' => 'S2'),
            array('name' => 'Magister Akuntansi',           'code' => '57', 'faculties_id' => Faculty::where('order', 5)->first()->id, 'alias' => 'MEKA',   'level' => 'S2'),
            array('name' => 'Seni Rupa Dan Desain',         'code' => '61', 'faculties_id' => Faculty::where('order', 6)->first()->id, 'alias' => '3SR',    'level' => 'D3'),
            array('name' => 'Seni Rupa Murni',              'code' => '62', 'faculties_id' => Faculty::where('order', 6)->first()->id, 'alias' => 'SRM',    'level' => 'S1'),
            array('name' => 'Desain Interior',              'code' => '63', 'faculties_id' => Faculty::where('order', 6)->first()->id, 'alias' => 'DIN',    'level' => 'S1'),
            array('name' => 'Desain Komunikasi Visual',     'code' => '64', 'faculties_id' => Faculty::where('order', 6)->first()->id, 'alias' => 'DKV',    'level' => 'S1'),
            array('name' => 'Arsitektur',                   'code' => '65', 'faculties_id' => Faculty::where('order', 6)->first()->id, 'alias' => 'ARS',    'level' => 'S1'),
            array('name' => 'Teknik Informatika',           'code' => '72', 'faculties_id' => Faculty::where('order', 7)->first()->id, 'alias' => 'TIF',    'level' => 'S1'),
            array('name' => 'Sistem Informasi',             'code' => '73', 'faculties_id' => Faculty::where('order', 7)->first()->id, 'alias' => 'SIF',    'level' => 'S1'),
            array('name' => 'Magister Ilmu Komputer',       'code' => '79', 'faculties_id' => Faculty::where('order', 7)->first()->id, 'alias' => 'MIK',    'level' => 'S2'),
            array('name' => 'Ilmu Hukum',                   'code' => '87', 'faculties_id' => Faculty::where('order', 8)->first()->id, 'alias' => 'HKM',    'level' => 'S1'),
            array('name' => 'Pendidikan Dokter Gigi',       'code' => '90', 'faculties_id' => Faculty::where('order', 9)->first()->id, 'alias' => 'KDG',    'level' => 'S1'),
            array('name' => 'Profesi Dokter Gigi',          'code' => '95', 'faculties_id' => Faculty::where('order', 9)->first()->id, 'alias' => 'PDG',    'level' => 'PF')
        );

        foreach ($data as $item) {
            StudyProgram::updateOrCreate(
                [
                    'code'  => $item['code'],
                    'name'  => $item['name'],
                    'alias' => $item['alias'],
                    'level' => $item['level'],
                ],
                $item
            );
        }
    }
}
