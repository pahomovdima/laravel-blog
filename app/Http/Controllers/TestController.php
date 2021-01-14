<?php

namespace App\Http\Controllers;

use \App\Models\BlogPost;

class TestController extends Controller
{
    /**
     * test
     */
    public function index()
    {
        $postsCollection = BlogPost
            ::select(['id'])
            ->where('category_id', 1)
            ->where('is_published', 1)
            ->get();

        $posts = [];
        foreach ($postsCollection as $post) {
            $posts[] = $post->id;
        }

        $postId = $posts[rand(0, count($posts) - 1)];

        echo $postId;
    }
}
