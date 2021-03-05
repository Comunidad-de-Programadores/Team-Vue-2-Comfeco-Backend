<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgesSeeder extends Seeder
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
                'name' => 'Javascript',
                'image_url' => 'badges/javascript.png',
                'order' => 1
            ],
            [
                'name' => 'PHP',
                'image_url' => 'badges/php.png',
                'order' => 1
            ],
            [
                'name' => 'Vue',
                'image_url' => 'badges/vue.png',
                'order' => 1
            ],
            [
                'name' => 'Angular',
                'image_url' => 'badges/angular.png',
                'order' => 1
            ],
            [
                'name' => 'React',
                'image_url' => 'badges/react.png',
                'order' => 1
            ],
            [
                'name' => 'Node.js',
                'image_url' => 'badges/node.png',
                'order' => 1
            ],
        ];

        foreach ($models as $key => $model) {
            $modelObj = Badge::create($model);
        }
    }
}
