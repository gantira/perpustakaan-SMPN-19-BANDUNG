<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
        	'name'		=> 'Admin',
        	'email' 	=> 'admin@gmail.com',
        	'password'	=> 'qweqwe',
        ]);

        $user->assignRole('admin');
    }
}
