<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
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
                'email' => 'super@admin.com',
                'password' => 'comf3c0$2021',
                'roles' => 1
            ]
        ];

        foreach ($models as $key => $model) {
            $current_model = $model;
            unset($current_model["roles"]);
            $model_obj = User::create($current_model);
            $model_obj->roles()->sync($model["roles"]);
        }
    }
}
