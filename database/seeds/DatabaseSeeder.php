<?php

use Illuminate\Database\Seeder;
use \App\Models\BlogPost;
use \App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
//        $this->call(RolesTableSeeder::class);
//        $this->call(UsersTableSeeder::class);
//        $this->call(BlogCategoriesTableSeeder::class);
//        factory(BlogPost::class, 100)->create();
        factory(Comment::class, 25)->create();
    }
}
