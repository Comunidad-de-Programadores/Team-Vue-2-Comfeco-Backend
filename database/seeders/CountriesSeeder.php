<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            [
                'name' => 'Perú',
                'order' => 1
            ],
            [
                'name' => 'Venezuela',
                'order' => 2
            ],
            [
                'name' => 'Colombia',
                'order' => 3
            ],
            [
                'name' => 'Chile',
                'order' => 4
            ],
        ];

        foreach ($models as $key => $model) {
            $modelObj = Country::create($model);
        }
    }
}
