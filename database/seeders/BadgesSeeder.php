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
                'description' => 'Debes superar el nivel de js',
                'order' => 1
            ],
            [
                'name' => 'PHP',
                'image_url' => 'badges/php.png',
                'description' => 'Debes superar el nivel de php',
                'order' => 1
            ],
            [
                'name' => 'Vue',
                'image_url' => 'badges/vue.png',
                'description' => 'Debes superar el nivel de vue',
                'order' => 1
            ],
            [
                'name' => 'Angular',
                'image_url' => 'badges/angular.png',
                'description' => 'Debes superar el nivel de angular',
                'order' => 1
            ],
            [
                'name' => 'React',
                'image_url' => 'badges/react.png',
                'description' => 'Debes superar el nivel de react',
                'order' => 1
            ],
            [
                'name' => 'Node.js',
                'image_url' => 'badges/node.png',
                'description' => 'Debes superar el nivel de node',
                'order' => 1
            ],
            [
                'name' => 'Login',
                'image_url' => 'badges/login.png',
                'description' => 'Debes realizar tu primer login para obtener la medalla',
                'order' => 1
            ],
            [
                'name' => 'Update',
                'image_url' => 'badges/update.png',
                'description' => 'Debes actualizar tu perfil, para obtener esta medalla',
                'order' => 1
            ],
        ];

        foreach ($models as $key => $model) {
            $modelObj = Badge::create($model);
        }
    }
}
