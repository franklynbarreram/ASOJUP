<?php

use Illuminate\Database\Seeder;

// Models
use App\Models\NeedType;
use App\Models\Need;

// External libs
use Faker\Factory as Faker;

class NeedSeeder extends Seeder
{
    const MAX_NEEDS = 25;

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
        $needTypes = NeedType::all();

        for ($i = 0; $i < self::MAX_NEEDS; $i++) {
            $payload = [
                'name' => $this->faker->words(3, TRUE),
                'description' => $this->faker->paragraph(),
                'need_type_id' => $needTypes->random()->id,
            ];

            Need::create($payload);
        }
    }
}
