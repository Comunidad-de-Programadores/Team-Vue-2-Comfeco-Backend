<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Technology;
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
        // $this->call(CountriesSeeder::class);
        // $this->call(AreasSeeder::class);
        // $this->call(RolesSeeder::class);
        // $this->call(UsersSeeder::class);
        // $this->call(SponsorsSeeder::class);
        // $this->call(WorkshopSeeder::class);
        // $this->call(CommunitiesSeeder::class);
        // $this->call(MentorsSeeder::class);
        // $this->call(BadgesSeeder::class);
        Technology::factory(2)->create();
        Team::factory(5)->create();
        $this->call(UserTeamSeeder::class);
    }
}
