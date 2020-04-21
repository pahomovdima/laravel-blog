<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Автор неизвестен',
                'email' => 'author_unknow@g.g',
                'password' => bcrypt(Str::random(16))
            ],
            [
                'name' => 'Автор',
                'email' => 'authorl@g.g',
                'password' => bcrypt('123123')
            ]
        ];

        DB::table('users')->insert($data);
    }
}
