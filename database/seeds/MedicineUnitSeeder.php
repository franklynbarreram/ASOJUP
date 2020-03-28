<?php

use Illuminate\Database\Seeder;

use App\Models\MedicineUnit;

class MedicineUnitSeeder extends Seeder
{

    protected $data = [
        [
            'name'  =>  'Centímetros Cúbicos',
            'short_name'    =>  'cc'
        ],
        [
            'name'  =>  'Mililitros',
            'short_name'    =>  'ml'
        ],
        [
            'name'  =>  'Gramos',
            'short_name'    =>  'g'
        ],
        [
            'name'  =>  'Miligramos',
            'short_name'    =>  'mg'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $d) {
            MedicineUnit::create([
                'name'  =>  $d['name'],
                'short_name'    =>  $d['short_name']
            ]);
        }
    }
}
