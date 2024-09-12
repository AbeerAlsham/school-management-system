<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Accounts\{Role, Permission};

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = json_decode(file_get_contents('database\RolesPermissions.json'), true);

        foreach ($data['permissions'] as $name) {
            Permission::create(['name' => $name]);
        }

        foreach ($data['roles'] as $roleData) {
            $role = Role::create(['name' => $roleData['name']]);
            $role->permessions()->attach(
                Permission::whereIn('name', $roleData['permissions'])->pluck('id')
            );
        }
    }
}
