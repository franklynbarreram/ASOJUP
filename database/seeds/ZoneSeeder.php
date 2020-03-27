<?php

use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{

    protected $data = [
        'San Antonio', 'El Piñal', 'San Cristóbal'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $d) {
            Zone::create([
                'name'  =>  $d
            ]);
        }
    }
}
