<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workshop;

class WorkshopSeeder extends Seeder
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
                'name' => 'State of javascript',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 1,
                'fecha_curso' => '2021-03-10 18:12:49'
            ],
            [
                'name' => 'Angular Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 2,
                'fecha_curso' => '2021-03-10 18:12:49'
            ],
            [
                'name' => 'Vue Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 3,
                'fecha_curso' => '2021-02-26 18:12:49'
            ],
            [
                'name' => 'Svelte Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 4,
                'fecha_curso' => '2021-03-10 18:12:49'
            ],
            [
                'name' => 'React Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 5,
                'fecha_curso' => '2021-03-10 18:12:49'
            ],
            [
                'name' => 'Vue Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 6,
                'fecha_curso' => '2021-03-10 18:12:49'
            ],
            [
                'name' => 'Angular Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 7,
                'fecha_curso' => '2021-03-10 18:12:49'
            ],
            [
                'name' => 'React Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 1,
                'fecha_curso' => '2021-02-01 18:12:49'
            ],
            [
                'name' => 'Svelte Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 2,
                'fecha_curso' => '2021-02-11 18:12:49'
            ],
            [
                'name' => 'Flutter Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 3,
                'fecha_curso' => '2021-02-10 18:12:49'
            ],
            [
                'name' => 'Flutter Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 4,
                'fecha_curso' => '2021-03-10 18:12:49'
            ],
        ];

        foreach ($models as $key => $model) {
            $modelObj = Workshop::create($model);
        }
    }
}