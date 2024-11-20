<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account\{Role, Permission};
use Illuminate\Support\Facades\Route;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //استخراج اسماء جميع الراوتات ضمن كل ملف
        $routes = Route::getRoutes();
        $apiNames = [];

        // المرور عبر كل راوت
        foreach ($routes as $route) {
            // التحقق مما إذا كان للراوت اسم
            if ($route->getName() && !str_starts_with($route->getName(), 'generated')) {
                // إضافة الاسم إلى المصفوفة
                $apiNames[] = $route->getName();
            }
        }
        // تخزين الأذونات في قاعدة البيانات
        foreach ($apiNames as $permission) {
            Permission::create(['name' => $permission]);
        }

        ///////////////////////////////////////////////////////
        //اسناد جميع الصلاحيات للآدمن
        $role = Role::create(['name' => 'إداري']);
        $permissions = Permission::all();
        $role->permessions()->attach($permissions);
        
        ////////////////////////////////////////////////////
        //استخراج صلاحيات كل دور
        $roleFiles = glob('database/RolesAndPermissions/*.json');

        foreach ($roleFiles as $file) {
            $data = json_decode(file_get_contents($file), true);
            if ($data) {
                // إنشاء الدور
                $role = Role::create(['name' => $data['name']]);
                // إضافة الصلاحيات للدور
                $role->permessions()->attach(
                    Permission::whereIn('name', $data['permissions'])->pluck('id')
                );
            }
        }
    }
}
