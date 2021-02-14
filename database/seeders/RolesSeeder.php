<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
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
                'name' => 'Super Administrador',
                'code' => '100'
            ],
            [
                'name' => 'Administrador General',
                'code' => '99'
            ],
           
            [
                'name' => 'Clientes',
                'code' => '80'
            ]
        ];

        foreach ($models as $key => $model) {
            $modelObj = Role::create($model);
        }
    }
}
