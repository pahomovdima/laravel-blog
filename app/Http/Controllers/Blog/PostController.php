<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Repositories\BlogCommentRepository;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;

class PostController extends Controller {

    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCommentRepository
     */
    private $blogCommentRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->blogPostRepository = app(blogPostRepository::class);
        $this->blogCommentRepository = app(blogCommentRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index () {
        $paginator = $this->blogPostRepository->getAllInRootCategory(5);

        return view('blog.posts.index', compact('paginator'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show (Request $request, $slug) {
        $item = $this->blogPostRepository->getShow($slug);
        $comments = $this->blogCommentRepository->getShow($item->id);
        $user = $request->user();

        if ($user) {
            $userId = $user->id;
        } else {
            $userId = null;
        }

        if (!$item) {
            abort(404);
        }

        return view('blog.posts.show', compact('item', 'comments', 'userId'));
    }

}
