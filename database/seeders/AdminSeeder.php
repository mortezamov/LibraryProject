<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * @var User $user
         */

        $user = User::query()->create([
           'name'=>'Morteza Movahedi',
            'email'=>'morteza.movahedi@gmail.com',
            'password'=>bcrypt('my2270963'),
        ]);

//        $permissions=Permission::all();
//        $user->givePermissionTo('create post');
    }
}
