<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            [
                'name' => 'Автор',
                'email' => 'authorl@g.g',
                'password' => bcrypt('66699911'),
                'role_id' => 2
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.admin',
                'password' => bcrypt('66699911'),
                'role_id' => 1
            ]
        ];

        DB::table('users')->insert($data);
    }
}
