<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::insert([
            ['name' => 'create post','guard_name' => 'web'],
            ['name' => 'read post'  ,'guard_name' => 'web'],
            ['name' => 'update post','guard_name' => 'web'],
            ['name' => 'delete post','guard_name' => 'web'],
        ]);
    }
}
