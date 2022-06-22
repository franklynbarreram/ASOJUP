<?php

use Illuminate\Database\Seeder;

// Models
use App\Models\InscribedUserMedicine;
use App\Models\InscribedUser;
use App\Models\Medicine;

class InscribedUserMedicineSeeder extends Seeder
{
    const MAX_MEDICINES_PER_USER = 2;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = InscribedUser::all();
        $medicines = Medicine::all();

        foreach($users as $user) {
            for ($i = 0; $i < self::MAX_MEDICINES_PER_USER; $i ++) {
                $payload = [
                    'inscribed_user_id' => $user->id,
                    'medicine_id' => $medicines->random()->id,
                ];

                InscribedUserMedicine::create($payload);
            }
        }
    }
}
