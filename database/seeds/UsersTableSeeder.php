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

        User::create([
            'name'  =>  'Delegado',
            'email' =>  'delegado@delegado.com',
            'password'  =>  bcrypt('123456'),
            'zone_id'   =>  1,
            'role_id'   =>  2,
            'remember_token'    =>  null,
        ]);

        User::create([
            'name'  =>  'Inscrito',
            'email' =>  'inscrito@inscrito.com',
            'password'  =>  bcrypt('123456'),
            'zone_id'   =>  1,
            'role_id'   =>  3,
            'remember_token'    =>  null,
            //aqui falta el id del inscrito como fk
        ]);
    }
}
