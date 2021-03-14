<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $availableTeams = ["Team Vue", "Team Angular", "Team Svelte", "Team Vanilla", "Team Full Stack", "Team No Code"];
        return [
            "name" => $this->faker->unique()->randomElement($availableTeams),
            "description" => $this->faker->text(100),
            "technology_id" => Technology::all()->random(1)->first()->id
        ];
    }
}
