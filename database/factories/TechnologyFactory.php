<?php

namespace Database\Factories;

use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechnologyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Technology::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $availableTechnologies = ["Javascript", "Typescript"];
        $colors = ["blue", "yellow"];
        return [
            "name" => $this->faker->unique()->randomElement($availableTechnologies),
            "description" => $this->faker->text(100),
            "color" => $this->faker->randomElement($colors)
        ];
    }
}
