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
                'name' => 'Sociable',
                'image_url' => 'badges/sociable.png',
                'description' => 'Medalla por actualizar perfil',
                'how_win' => 'Debes actualizar tu perfil, para obtener esta medalla',
                'order' => 1
            ],
            [
                'name' => 'Participativo',
                'image_url' => 'badges/participative.png',
                'description' => 'Medalle por inscribirse al menos a un evento',
                'how_win' => 'Debes inscribirte al menos a un evento',
                'order' => 2
            ],
            [
                'name' => 'Javascript',
                'image_url' => 'badges/javascript.png',
                'description' => 'Javascript el lenguaje de programación orientado para web apps.',
                'how_win' => 'Debes superar el nivel de js',
                'order' => 3
            ],
            [
                'name' => 'PHP',
                'image_url' => 'badges/php.png',
                'description' => 'Lenguaje de programación del lado del servidor antiguo pero robusto',
                'how_win' => 'Debes superar el nivel de php',
                'order' => 4
            ],
        ];

        foreach ($models as $key => $model) {
            $modelObj = Badge::create($model);
        }
    }
}
