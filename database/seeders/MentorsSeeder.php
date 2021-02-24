<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mentor;

class MentorsSeeder extends Seeder
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
                'name' => 'Bezael Pérez',
                'master_on' => 'javascript',
                'master_on_image' => 'images/mentors-images/javascript.png',
                'image_url' => 'images/mentors-images/bezael-perez.jpeg',
                'order' => 1
            ],
            [
                'name' => 'Nicolás Schürmann',
                'master_on' => 'javascript',
                'master_on_image' => 'images/mentors-images/javascript.png',
                'image_url' => 'images/mentors-images/nicolas-schurmann.jpeg',
                'order' => 2
            ],
            [
                'name' => 'Diego Montoya',
                'master_on' => 'javascript',
                'master_on_image' => 'images/mentors-images/javascript.png',
                'image_url' => 'images/mentors-images/diego-montoya.jpg',
                'order' => 3
            ],
            [
                'name' => 'Sacha Lifszyc',
                'master_on' => 'javascript',
                'master_on_image' => 'images/mentors-images/javascript.png',
                'image_url' => 'images/mentors-images/sacha-lifszyc.jpg',
                'order' => 4
            ],
            [
                'name' => 'Noemi Leon',
                'master_on' => 'javascript',
                'master_on_image' => 'images/mentors-images/javascript.png',
                'image_url' => 'images/mentors-images/noemi-leon.jpg',
                'order' => 5
            ],
           
           
        ];

        foreach ($models as $key => $model) {
            $modelObj = Mentor::create($model);
        }
    }
}
