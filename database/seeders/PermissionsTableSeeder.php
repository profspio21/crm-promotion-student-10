<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'title' => 'user_management_access',
            ],
            [
                'title' => 'role_permission_access',
            ],
            [
                'title' => 'permission_delete',
            ],
            [
                'title' => 'role_delete',
            ],
            [
                'title' => 'user_delete',
            ],
            [
                'title' => 'staff_create',
            ],
            [
                'title' => 'staff_edit',
            ],
            [
                'title' => 'staff_show',
            ],
            [
                'title' => 'staff_delete',
            ],
            [
                'title' => 'staff_access',
            ],
            [
                'title' => 'registrant_create',
            ],
            [
                'title' => 'registrant_edit',
            ],
            [
                'title' => 'registrant_show',
            ],
            [
                'title' => 'registrant_delete',
            ],
            [
                'title' => 'registrant_access',
            ],
            [
                'title' => 'profile_password_edit',
            ],
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
            [
                'title' => 'dashboard_staff',
            ],
            [
                'title' => 'dashboard_registrant',
            ],
            [
                'title' => 'information_access',
            ],
            [
                'title' => 'information_crud',
            ],
            [
                'title' => 'selection_information_access',
            ],
            [
                'title' => 'activity_information_access',
            ],
        ];

        Permission::insert($permissions);
    }
}