<?php

use Illuminate\Database\Seeder;

// Models
use App\Models\InscribedUserNeed;
use App\Models\InscribedUser;
use App\Models\Need;

class InscribedUserNeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = InscribedUser::all();
        $needs = Need::all();

        foreach($users as $user) {
            $payload = [
                'inscribed_user_id' => $user->id,
                'need_id' => $needs->random()->id,
            ];

            InscribedUserNeed::create($payload);
        }
    }
}
