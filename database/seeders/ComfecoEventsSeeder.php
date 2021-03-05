<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComfecoEvent;

class ComfecoEventsSeeder extends Seeder
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
                'name' => 'Community Fest and Code',
                'content' => '<p>Content</p>',
                'portrait_image_url' => 'comfeco-events/1-portrait.png',
                'background_image_url' => 'comfeco-events/1-background.png',
                'start' => '2021-03-05 00:00:00',
                'end' => '2021-03-10 23:59:00',
                'participants' => 100,
                'is_visible' => true,
            ],
            [
                'name' => 'Evento 2',
                'content' => '<p>Content</p>',
                'portrait_image_url' => 'comfeco-events/2-portrait.png',
                'background_image_url' => 'comfeco-events/2-background.png',
                'start' => '2021-03-06 00:00:00',
                'end' => '2021-03-30 23:59:00',
                'participants' => 500,
                'is_visible' => true,
            ],
            [
                'name' => 'Event 3',
                'content' => '<p>Content</p>',
                'portrait_image_url' => 'comfeco-events/3-portrait.png',
                'background_image_url' => 'comfeco-events/3-background.png',
                'start' => '2021-03-08 00:00:00',
                'end' => '2021-03-10 23:59:00',
                'participants' => 50,
                'is_visible' => true,
            ],
           
        ];

        foreach ($models as $key => $model) {
            $modelObj = ComfecoEvent::create($model);
        }
    }
}
