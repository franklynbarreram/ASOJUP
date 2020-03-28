<?php

use Illuminate\Database\Seeder;

use App\Models\NeedType;

class NeedTypeSeeder extends Seeder
{
    protected $data = [
        'Enfermedad', 'Solicitud'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $d) {
            NeedType::create([
                'name'  =>  $d
            ]);
        }
    }
}
