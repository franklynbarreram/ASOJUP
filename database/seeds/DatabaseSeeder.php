<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            RoleSeeder::class,
            ZoneSeeder::class,
            NeedTypeSeeder::class,
            NeedSeeder::class,
            // RequestSeeder::class,
            MedicineFormSeeder::class,
            MedicineUnitSeeder::class,
            MedicineSeeder::class,
            UsersTableSeeder::class,
            InscribedUserSeeder::class,
            InscribedUserMedicineSeeder::class,
            InscribedUserNeedSeeder::class,
            // InscribedUserRelationshipSeeder::class,
        ];

        foreach ($classes as $class) {
            $this->call($class);
        }
    }
}
