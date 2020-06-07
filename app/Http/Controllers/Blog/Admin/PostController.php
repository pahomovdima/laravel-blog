<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Http\Requests\BlogPostCreateRequest;

class PostController extends BaseController {

    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * PostController constructor.
     */
    public function __construct () {
        parent::__construct();

        $this->blogPostRepository = app(blogPostRepository::class);
        $this->blogCategoryRepository = app(blogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index () {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create () {
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\BlogPostCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store (BlogPostCreateRequest $request) {
        $data = $request->input();
        $item = (new BlogPost())->create($data);

        if ($item) {
            return redirect()->route('blog.admin.posts.edit', [$item->id])
                ->with(['success' => 'Успешно сохранен']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($id) {
        $item = $this->blogPostRepository->getEdit($id);

        if (!$item) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();
        $delimiter = '';

        return view('blog.admin.posts.edit', compact('item', 'categoryList', 'delimiter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\BlogPostUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (BlogPostUpdateRequest $request, $id) {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors([ 'msg' => "Запись id=[{$id}] не найдена" ])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with([ 'success' => 'Успешно сохранено' ]);
        } else {
            return back()
                ->withErrors([ 'msg' => 'Ошибка сохранения' ])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id) {
        $result = BlogPost::destroy($id);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.index')
                ->with([ 'success' => "Запись id=[{$id}] удалена" ]);
        } else {
            return back()->withErrors([ 'msg' => 'Ошибка удаления' ]);
        }
    }

}
