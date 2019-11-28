<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	RolesAndPermissionsSeeder::class,
        	SettingTableSeeder::class,
        	UsersTableSeeder::class, 
        ]);
    }
}
