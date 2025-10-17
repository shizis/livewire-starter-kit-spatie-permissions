<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $permissions = [
            'admin_access',
            'user_access',
            'user_view',
            'user_create',
            'user_update',
            'user_delete',
        ];

        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        foreach ($permissions as $key => $value) {
            Permission::create(['name' => $value]);
        }

        $admin->syncPermissions($permissions);
        $user->syncPermissions([
            'user_access',
            'user_view',
        ]);

        User::factory()->create([
            'name' => 'Shizi',
            'email' => 'shizi@gmail.com',
            'password' => 'shizi2411'
        ])->syncRoles('admin');

        User::factory()->create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'shizi2411'
        ])->syncRoles('user');
    }
}
