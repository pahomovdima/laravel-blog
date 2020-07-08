<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            [
                'name' => 'Админ',
                'description' => 'Админ',
            ],
            [
                'name' => 'Редактор статей',
                'description' => 'Редактор статей',
            ],
            [
                'name' => 'Зарегестрированный пользователь',
                'description' => 'Зарегестрированный пользователь',
            ]
        ];

        DB::table('roles')->insert($data);
    }
}
