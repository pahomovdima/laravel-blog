<?php

namespace App\Http\Controllers;

use \App\Models\BlogPost;

class TestController extends Controller {

    public function index () {
        $postsCollection = BlogPost
            ::select(['id'])
            ->where('category_id', 1)
            ->where('is_published', 1)
            ->get();

        $posts = [];

        foreach ($postsCollection as $post) {
            $posts['id'][] = $post->id;
        }

        $postId = $posts['id'][rand(0, count($posts['id']) - 1)];

        echo $postId;
    }

}
