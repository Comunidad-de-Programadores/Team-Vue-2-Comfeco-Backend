<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorsSeeder extends Seeder
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
                'name' => 'Huawei',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-huawei.webp',
                'order' => 1
            ],
            [
                'name' => 'Tekki TV',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-tekkitv.webp',
                'order' => 2
            ],
            [
                'name' => 'Fernando Herrera',
                'image_url' => 'https://img-a.udemycdn.com/user/200_H/11767934_4361_2.jpg',
                'order' => 3
            ],
            [
                'name' => 'Domini Code',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-dominicode.webp',
                'order' => 4
            ],
            [
                'name' => 'EGGHEAD',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-egghead.webp',
                'order' => 5
            ],
            [
                'name' => 'Código Facilito',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-codigofacilito.webp',
                'order' => 6
            ],
            [
                'name' => 'CODELYTV',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-codelytv.webp',
                'order' => 7
            ],
            [
                'name' => 'Stackly Code',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-stacklycode.webp',
                'order' => 8
            ],
            [
                'name' => 'Leónidas Esteban',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-leonidas_esteban.webp',
                'order' => 9
            ],
            [
                'name' => 'José Dimas Luján',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-jose_dimas_lujan.webp',
                'order' => 10
            ],
            [
                'name' => 'Latam Dev',
                'image_url' => 'https://www.comfeco.com/images/sponsors/sponsor-latamdev.webp',
                'order' => 11
            ],
        ];

        foreach ($models as $key => $model) {
            $modelObj = Sponsor::create($model);
        }
    }
}
