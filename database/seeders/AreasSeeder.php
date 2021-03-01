<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasSeeder extends Seeder
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
                'name' => 'Frontend',
                'order' => 1,
            ],
            [
                'name' => 'Backend',
                'order' => 2,
            ],
            [
                'name' => 'DevOps',
                'order' => 3,
            ],
            [
                'name' => 'Video Game Developers',
                'order' => 4,
            ],
            [
                'name' => 'UI/UX',
                'order' => 5,
            ],
            [
                'name' => 'Database Developer',
                'order' => 6,
            ],
            [
                'name' => 'Cloud Computing',
                'order' => 7,
            ],
        ];

        foreach ($models as $key => $model) {
            $modelObj = Area::create($model);
        }
    }
}
