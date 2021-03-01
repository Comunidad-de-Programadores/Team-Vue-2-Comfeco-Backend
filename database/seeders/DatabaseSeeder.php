<?php

namespace Database\Seeders;

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
        $this->call(CountriesSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SponsorsSeeder::class);
        $this->call(WorkshopSeeder::class);
        $this->call(CommunitiesSeeder::class);
        $this->call(MentorsSeeder::class);
    }
}
