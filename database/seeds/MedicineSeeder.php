<?php

use Illuminate\Database\Seeder;

// Models
use App\Models\MedicineForm;
use App\Models\MedicineUnit;
use App\Models\Medicine;

// External libs
use Faker\Factory as Faker;

class MedicineSeeder extends Seeder
{
    const MAX_MEDICINES = 100;

    /**
     * @var object
     */
    protected $faker;

    /**
     * Instances a new seeder class
     * 
     * @return void
     */
    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicineForms = MedicineForm::all();
        $medicineUnits = MedicineUnit::all();

        for ($i = 0; $i < self::MAX_MEDICINES; $i++) {
            $payload = [
                'name' => $this->faker->words(3, TRUE),
                'concentration' => $this->faker->numberBetween(100, 1000),
                'box_quantity' => $this->faker->numberBetween(2, 30),
                'medicine_form_id' => $medicineForms->random()->id,
                'medicine_unit_id' => $medicineUnits->random()->id,
            ];

            Medicine::create($payload);
        }
    }
}
