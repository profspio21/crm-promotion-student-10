<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class AdditionalPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            [
                'title' => 'activity_information_access',
            ],
        ];

        $permissions = Permission::insert($permissions);
        Role::findOrFail(1)->permissions()->syncWithoutDetaching($permissions);
    }
}
