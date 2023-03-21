<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'User',
        ]);
        $this->call(PermissionSeeder::class);
        $perms = Permission::all();
        Role::factory(20)->create();
        // Image::factory(30)->create();
        Role::all()->each(function($role) {
            \App\Models\User::factory(random_int(1, 7))->create([
                'role_id' => $role->id,
            ]);
        });

        Role::where('id', '<>', 1)->get()->each(function($role) use($perms) {
            $role->permissions()->attach($perms->random(random_int(1, 5)));
        });
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
