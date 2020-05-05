<?php

use Illuminate\Database\Seeder;

class UserGroupsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            [
                'name' => 'Админ',
            ],
            [
                'name' => 'Редактор статей',
            ],
            [
                'name' => 'Зарегестрированный пользователь',
            ]
        ];

        DB::table('user_groups')->insert($data);
    }
}
