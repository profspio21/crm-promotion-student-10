<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username'           => 'admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2024-02-15 19:30:25',
                'verification_token' => '',
            ],
            [
                'username'           => 'staff',
                'email'              => 'staff@staff.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2024-02-15 19:30:25',
                'verification_token' => '',
            ],
            [
                'username'           => 'user',
                'email'              => 'user@user.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2024-02-15 19:30:25',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}