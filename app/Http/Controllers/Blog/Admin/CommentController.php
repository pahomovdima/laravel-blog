<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\Comment;
use App\Repositories\BlogCommentRepository;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;

class CommentController extends BaseController
{

    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCommentRepository
     */
    private $blogCommentRepository;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(blogPostRepository::class);
        $this->blogCommentRepository = app(blogCommentRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogCommentRepository->getAllWithPaginate();

        return view('blog.admin.comments.index', compact('paginator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogCommentRepository->getEdit($id);

        if (!$item) {
            abort(404);
        }

        return view('blog.admin.comments.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = $this->blogCommentRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors([ 'msg' => "Запись id=[{$id}] не найдена" ])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.comments.edit', $item->id)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Comment::destroy($id);

        if ($result) {
            return redirect()
                ->route('blog.admin.comments.index')
                ->with([ 'success' => "Запись id=[{$id}] удалена" ]);
        } else {
            return back()->withErrors([ 'msg' => 'Ошибка удаления' ]);
        }
    }
}
