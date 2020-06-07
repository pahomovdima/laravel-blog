<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;

/**
 * Управление категориями блога
 *
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController {

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct () {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index () {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(15);
        $delimiter = '';

        return view('blog.admin.categories.index', compact('paginator', 'delimiter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create () {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        $delimiter = '';

        return view('blog.admin.categories.edit', compact('item', 'categoryList', 'delimiter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\BlogCategoryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store (BlogCategoryCreateRequest $request) {
        $data = $request->input();
        $item = (new BlogCategory())->create($data);

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
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
     * @param BlogCategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function edit ($id) {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();
        $delimiter = '';

        return view('blog.admin.categories.edit', compact('item', 'categoryList', 'delimiter'));
    }

    /**
     * Update the specified resource in storage.
     *
     *  @param \App\Http\Requests\BlogCategoryUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (BlogCategoryUpdateRequest $request, $id) {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors([ 'msg' => "Запись id=[{$id}] не найдена" ])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
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
        $result = BlogCategory::find($id)->forceDelete();

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.index')
                ->with([ 'success' => "Запись id=[{$id}] удалена" ]);
        } else {
            return back()->withErrors([ 'msg' => 'Ошибка удаления' ]);
        }
    }

}
