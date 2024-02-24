<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionExpoSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'title' => 'expo_access',
            ],
            [
                'title' => 'expo_create',
            ],
            [
                'title' => 'expo_delete',
            ],
            [
                'title' => 'expo_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}