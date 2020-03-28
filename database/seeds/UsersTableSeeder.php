<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  =>  'Admin',
            'email' =>  'admin@admin.com',
            'password'  =>  bcrypt('123456'),
            'zone_id'   =>  1,
            'role_id'   =>  1,
            'remember_token'    =>  null,
        ]);
    }
}
