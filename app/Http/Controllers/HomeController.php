<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Repositories\BlogPostRepository;

class HomeController extends Controller {

    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->blogPostRepository = app(blogPostRepository::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index () {
        $posts = $this->blogPostRepository->getAllInRootCategory(3);

        return view('home', compact('posts'));
    }

}
