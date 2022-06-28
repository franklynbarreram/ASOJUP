<?php

use Illuminate\Database\Seeder;

use App\Models\InscribedUserRelationship;
use App\Models\InscribedUser;
use App\Models\Need;
use App\Models\Medicine;
use App\Models\Request;

class InscribedUserRelationshipSeeder extends Seeder
{
    const MAX_RELATIONSHIPS = 2;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = InscribedUser::all();
        $medicines = Medicine::all();
        $needs = Need::all();
        $requests = Request::all();

        foreach($users as $user) {
            for ($i = 0; $i < self::MAX_RELATIONSHIPS; $i ++) {

                $entity = $this->getRandomEntity($medicines, $needs, $requests);

                $payload = [
                    'inscribed_user_id' => $user->id,
                    'entity_id' => $entity->id,
                    'entity_type' => get_class($entity),
                ];

                InscribedUserRelationship::create($payload);
            }
        }
    }

    /**
     * 
     */
    private function getRandomEntity($medicines, $needs, $requests)
    {
        $randProb = rand(1, 100);

        if ($randProb <= 33) {
            return $medicines->random();
        } else if ($randProb > 33 && $randProb <= 66) {
            return $needs->random();
        } else {
            return $requests->random();
        }
    }
}
