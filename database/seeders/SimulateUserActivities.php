<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SimulateUserActivities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'ggalvez92@hotmail.com')->first();

        if (!is_null($user)) {
            $user->userActivities()->create(['activity' => 'testeando']);
        }
    }
}
