<?php

use Illuminate\Database\Seeder;

use App\Models\MedicineForm;

class MedicineFormSeeder extends Seeder
{
    protected $data = [
        [
            'name'  =>  'Comprimido',
            'short_name'    =>  'COMP'
        ],
        [
            'name'  =>  'Jarabe',
            'short_name'    =>  'JBE'
        ],
        [
            'name'  =>  'Gotas',
            'short_name'    =>  'GTS'
        ],
        [
            'name'  =>  'Ampolla',
            'short_name'    =>  'AMP'
        ],
        [
            'name'  =>  'Crema',
            'short_name'    =>  'CREMA'
        ],
        [
            'name'  =>  'Suspensión',
            'short_name'    =>  'SUSP'
        ],
        [
            'name'  =>  'Tableta',
            'short_name'    =>  'TABL'
        ],
        [
            'name'  =>  'Tónico',
            'short_name'    =>  'TON'
        ],
        [
            'name'  =>  'Unguento',
            'short_name'    =>  'UNG'
        ],
        [
            'name'  =>  'Emulsión',
            'short_name'    =>  'EMU'
        ],
        [
            'name'  =>  'Pomada',
            'short_name'    =>  'POM'
        ],
        [
            'name'  =>  'Infusión',
            'short_name'    =>  'INF'
        ],
        [
            'name'  =>  'Intravenoso',
            'short_name'    =>  'INTR'
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
            MedicineForm::create([
                'name'  =>  $d['name'],
                'short_name'    =>  $d['short_name']
            ]);
        }
    }
}
