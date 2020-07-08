<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;

class CommentController extends Controller {

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
     * @var array
     */
    private $validRules = [
        'comment' => 'required|string|min:10|max:255',
        'name' => 'required|string|min:5|max:255',
        'email' => 'required|string|email|unique:users',
        'post_id' => 'required|integer|exists:blog_posts,id'
    ];

    /**
     * @var array
     */
    private $validRulesUser = [
        'comment' => 'required|string|min:10|max:255'
    ];

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function send (Request $request) {
        $data = $request->input();
        $user = $request->user();

        if ($user) {
            $this->validate($request, $this->validRulesUser);

            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['user_id'] = $user->id;
        } else {
            $this->validate($request, $this->validRules);
        }

        $data['is_published'] = 0;
        $item = (new Comment())->create($data);

        if ($item) {
            $postSlug = $this->blogPostRepository->getSlugById($data['post_id']);
            return redirect()->route('blog.posts.show', $postSlug)
                ->with(['success' => 'Успешно сохранен']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

}
