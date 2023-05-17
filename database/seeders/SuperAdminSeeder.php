<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
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
                'email'     => 'super.admin@email.com',
                'password'  => Hash::make('ukm12345*'),
                'role'      => 'admin',
                'name'      => 'Super Admin'
            ],
        ];

        foreach ($data as $item) {
            $user = User::create(
                [
                    'email'     => $item['email'],
                    'password'  => $item['password'],
                    'role'      => $item['role'],
                ],
                $item
            );
            $user->userDetail()->create([
                'name'  => $item['name']
            ]);
        }
    }
}
