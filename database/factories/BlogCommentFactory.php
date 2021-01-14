<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use \App\Models\Comment;
use \App\Models\BlogPost;

$postsCollection = BlogPost
    ::select(['id'])
    ->where('category_id', 1)
    ->where('is_published', 1)
    ->get();

$posts = [];
foreach ($postsCollection as $post) {
    $posts[] = $post->id;
}

$factory->define(Comment::class, function (Faker $faker) use ($posts) {
    $name = $faker->name;
    $email = $faker->email;
    $comment = $faker->realText(rand(10, 100));
    $isPublished = rand(1, 5) > 1;

    $postId = $posts[rand(0, count($posts) - 1)];

    $createdAt = $faker->dateTimeBetween('-2 months', '-1 days');

    return [
        'post_id' => $postId,
        'name' => $name,
        'email' => $email,
        'comment' => $comment,
        'is_published' => $isPublished,
        'published_at' => $isPublished ? $faker->dateTimeBetween('-2 months', '-1 days') : null,
        'created_at' => $createdAt,
        'updated_at' => $createdAt
    ];
});
