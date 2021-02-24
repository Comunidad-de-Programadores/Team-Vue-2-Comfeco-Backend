<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Community;

class CommunitiesSeeder extends Seeder
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
                'name' => 'Comunidad de Programadores',
                'slug' => 'comunidad-de-programadores',
                'order' => 1
            ],
            [
                'name' => 'El lenguaje de los programadores',
                'slug' => 'el-lenguaje-de-los-programadores',
                'order' => 2
            ],
            [
                'name' => 'Latam Dev',
                'slug' => 'latam-dev',
                'order' => 3
            ],
           
        ];

        foreach ($models as $key => $model) {
            $modelObj = Community::create($model);
        }
    }
}
