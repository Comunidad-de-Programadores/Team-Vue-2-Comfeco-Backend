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
                'area' => 1
            ],
            [
                'name' => 'Angular Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 2
            ],
            [
                'name' => 'Vue Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 3
            ],
            [
                'name' => 'Svelte Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 4
            ],
            [
                'name' => 'React Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 5
            ],
            [
                'name' => 'Vue Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 6
            ],
            [
                'name' => 'Angular Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 7
            ],
            [
                'name' => 'React Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 1
            ],
            [
                'name' => 'Svelte Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 2
            ],
            [
                'name' => 'Flutter Basico',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 3
            ],
            [
                'name' => 'Flutter Medio',
                'url_social' => 'https://facebook.com',
                'name_user' => 'John Doe',
                'area' => 4
            ],
        ];

        foreach ($models as $key => $model) {
            $modelObj = Workshop::create($model);
        }
    }
}