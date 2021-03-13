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
                'description' => 'Javascript el lenguaje de scripting orientado a la web y a todo gracias a hoy en dia.',
                'how_win' => 'Debes superar el nivel de js',
                'order' => 1
            ],
            [
                'name' => 'PHP',
                'image_url' => 'badges/php.png',
                'description' => 'Lenguaje del lado del servidor antiguo pero robusto',
                'how_win' => 'Debes superar el nivel de php',
                'order' => 1
            ],
            [
                'name' => 'Vue',
                'image_url' => 'badges/vue.png',
                'description' => 'Herramienta, framework. Para agilizar el desarrollo en del lado del cliente con javascript',
                'how_win' => 'Debes superar el nivel de vue',
                'order' => 1
            ],
            [
                'name' => 'Angular',
                'image_url' => 'badges/angular.png',
                'description' => 'Herramienta, framework. Para agilizar el desarrollo en del lado del cliente con javascript',
                'how_win' => 'Debes superar el nivel de angular',
                'order' => 1
            ],
            [
                'name' => 'React',
                'image_url' => 'badges/react.png',
                'description' => 'Herramienta, framework. Para agilizar el desarrollo en del lado del cliente con javascript',
                'how_win' => 'Debes superar el nivel de react',
                'order' => 1
            ],
            [
                'name' => 'Node.js',
                'image_url' => 'badges/node.png',
                'description' => 'Un framework para desarrollo en aplicaciones del lado del servidor con el mismo javascript',
                'how_win' => 'Debes superar el nivel de node js',
                'order' => 1
            ],
            [
                'name' => 'Login',
                'image_url' => 'badges/login.png',
                'description' => 'Login de usuario',
                'how_win' => 'Debes realizar tu primer login para obtener la medalla',
                'order' => 1
            ],
            [
                'name' => 'Update',
                'image_url' => 'badges/update.png',
                'description' => 'Medalla por actualizar perfil',
                'how_win' => 'Debes actualizar tu perfil, para obtener esta medalla',
                'order' => 1
            ],
        ];

        foreach ($models as $key => $model) {
            $modelObj = Badge::create($model);
        }
    }
}
