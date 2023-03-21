<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::factory(1)->create([
            'name' => 'create news',
            'permission_name' => 'create news',
        ]);
        Permission::factory(1)->create([
            'name' => 'create book',
            'permission_name' => 'create book',
        ]);
        Permission::factory(1)->create([
            'name' => 'create photo',
            'permission_name' => 'create photo',
        ]);
        Permission::factory(1)->create([
            'name' => 'add role to users',
            'permission_name' => 'add role to users',
        ]);
        Permission::factory(1)->create([
            'name' => 'edit your news',
            'permission_name' => 'edit your news',
        ]);
        Permission::factory(1)->create([
            'name' => 'edit your book',
            'permission_name' => 'edit your book',
        ]);
        Permission::factory(1)->create([
            'name' => 'edit your post',
            'permission_name' => 'edit your post',
        ]);
        Permission::factory(1)->create([
            'name' => 'delete your post',
            'permission_name' => 'delete your post',
        ]);
        Permission::factory(1)->create([
            'name' => 'delete your book',
            'permission_name' => 'delete your book',
        ]);
        Permission::factory(1)->create([
            'name' => 'delete your news',
            'permission_name' => 'delete your news',
        ]);
    }
}
