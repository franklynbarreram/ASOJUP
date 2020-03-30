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
        $this->call([RoleSeeder::class]);
        $this->call([ZoneSeeder::class]);
        $this->call([NeedTypeSeeder::class]);
        $this->call([MedicineFormSeeder::class]);
        $this->call([MedicineUnitSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([InscritosSeeder::class]);
    }
}
