<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            'view posts',
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',

        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer']);

        // 3. Assign Permissions to Roles
        $adminRole->syncPermissions($permissions); // كل الصلاحيات
        $editorRole->syncPermissions(['create posts', 'edit posts']); // صلاحيات جزئية
        $viewerRole->syncPermissions(['view posts']); // للقراءة فقط

        // 4. Assign Role to First User (ID = 1)
        $user = User::find(1);
        if ($user) {
            $user->assignRole($adminRole); // تعيين الدور Admin
        }


    }
}
