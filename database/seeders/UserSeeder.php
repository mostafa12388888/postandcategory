<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => "mostafaAdmin",
            'user_name' => "mostafaAdmin",
            'phone' => '01060688891',
            'street' => "cairo",
            'city' => "cairo",
            'country' => "cairo",
            'status' => 1,
            'image' => null,
            'email' => "adminkostafa606888@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'role' => "admin",
            'roles_name' => ["owner"],
            ]);

            $role = Role::create(['name' => 'owner']);

            $permissions = Permission::pluck('id','id')->all();

            $role->syncPermissions($permissions);

            $user->assignRole([$role->id]);

        User::create([
            'name' => "mostafa",
            'roles_name' => ["user"],
            'user_name' => "mostafa",
            'phone' => '011060688891',
            'street' => "cairo",
            'city' => "cairo",
            'country' => "cairo",
            'status' => 1,
            'image' => null,
            'email' => "userkostafa606888@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);
        // User::factory()->count(10)->create();
    }
}
