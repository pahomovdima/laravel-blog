<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Requests\UserGroupCreateRequest;
use App\Http\Requests\UserGroupUpdateRequest;
use App\Models\UserGroup;
use App\Repositories\UserGroupRepository;

class UserGroupController extends BaseController {

    /**
     * @var UserGroupRepository
     */
    private $userGroupRepository;

    /**
     * UserGroupController constructor.
     */
    public function __construct () {
        parent::__construct();

        $this->userGroupRepository = app(UserGroupRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $paginator = $this->userGroupRepository->getAllWithPaginate();

        return view('user.admin.user_groups.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $item = new UserGroup();
        $userGroupList = $this->userGroupRepository->getForComboBox();

        return view('user.admin.user_groups.edit', compact('item', 'userGroupList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserGroupCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserGroupCreateRequest $request) {
        $data = $request->input();
        $item = (new UserGroup())->create($data);

        if ($item) {
            return redirect()->route('admin.user_groups.edit', [$item->id])
                ->with(['success' => 'Успешно сохранен']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $item = $this->userGroupRepository->getEdit($id);

        if (!$item) {
            abort(404);
        }

        $userGroupList = $this->userGroupRepository->getForComboBox();

        return view('user.admin.user_groups.edit', compact('item', 'userGroupList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserGroupUpdateRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserGroupUpdateRequest $request, $id) {
        $item = $this->userGroupRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors([ 'msg' => "Запись id=[{$id}] не найдена" ])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.user_groups.edit', $item->id)
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
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $result = UserGroup::destroy($id);

        if ($result) {
            return redirect()
                ->route('admin.user_groups.index')
                ->with([ 'success' => "Запись id=[{$id}] удалена" ]);
        } else {
            return back()->withErrors([ 'msg' => 'Ошибка удаления' ]);
        }
    }
}
