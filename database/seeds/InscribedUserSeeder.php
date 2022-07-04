<?php

use Illuminate\Database\Seeder;

// Models
use App\Models\InscribedUser;

// External libs
use Faker\Factory as Faker;

class InscribedUserSeeder extends Seeder
{
    const MAX_INSCRIBED_USERS = 100;

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
        $genderCollection = collect(['male', 'female']);

        $testUser = [
            'name' => 'Inscrito',
            'surname' => 'Global',
            'password' => bcrypt('123456'),
            'email' => 'inscrito@inscrito.com',
            'identification' => '924C33',
            'cicpc_id' => '32565645',
            'phone' => '04147458343',
            'address' => 'La concordia',
            'active'=> TRUE,
        ];

        InscribedUser::create($testUser);

        for ($i = 0; $i < self::MAX_INSCRIBED_USERS; $i++) {
            $payload = [
                'name' => $this->faker->name($genderCollection->random()),
                'surname' => $this->faker->lastName(),
                'password' => bcrypt('123456'),
                'email' => $this->faker->unique()->email,
                'identification' => $this->faker->isbn10(),
                'cicpc_id' => $this->faker->ean8(),
                'phone' => $this->faker->phoneNumber(),
                'address' => $this->faker->address(),
                'active'=> TRUE,
            ];

            InscribedUser::create($payload);
        }
    }
}
