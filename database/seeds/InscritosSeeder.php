<?php

use Illuminate\Database\Seeder;
use App\Models\InscribedUser;

class InscritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InscribedUser::create([
            'name'  =>  'Inscrito',
            'surname'=>'Global',
            'password'  =>  bcrypt('123456'),
            'email' =>  'inscrito@inscrito.com',
            'identification'=>'924C33',
            'cicpc_id'=>"32565645",
            'phone'=>"04147458343",
            'address'=>"La concordia",
            'active'=>"1"
        ]);
    }
}
