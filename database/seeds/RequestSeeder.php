<?php

use Illuminate\Database\Seeder;

// Models
use App\Models\Request;

// External libs
use Faker\Factory as Faker;

class RequestSeeder extends Seeder
{
    const MAX_REQUESTS = 25;

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

        for ($i = 0; $i < self::MAX_REQUESTS; $i++) {
            $payload = [
                'name' => $this->faker->words(3, TRUE),
                'description' => $this->faker->paragraph(),
            ];

            Request::create($payload);
        }
    }
}
