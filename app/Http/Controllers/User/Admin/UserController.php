<?php

namespace App\Http\Controllers\User\Admin;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\UserGroupRepository;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;

class UserController extends BaseController {

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserGroupRepository
     */
    private $userGroupRepository;

    /**
     * UserController constructor.
     */
    public function __construct () {
        parent::__construct();

        $this->userRepository = app(UserRepository::class);
        $this->userGroupRepository = app(UserGroupRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index () {
        $paginator = $this->userRepository->getAllWithPaginate();

        return view('user.admin.users.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create () {
        $item = new User();
        $userGroupList = $this->userGroupRepository->getForComboBox();

        return view('user.admin.users.edit', compact('item', 'userGroupList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store (UserCreateRequest $request) {
        $data = $request->input();
        $item = (new User())->create($data);

        if ($item) {
            return redirect()->route('admin.users.edit', [$item->id])
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
        $item = $this->userRepository->getEdit($id);

        if (!$item) {
            abort(404);
        }

        $userGroupList = $this->userGroupRepository->getForComboBox();

        return view('user.admin.users.edit', compact('item', 'userGroupList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (UserUpdateRequest $request, $id) {
        $item = $this->userRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors([ 'msg' => "Запись id=[{$id}] не найдена" ])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.users.edit', $item->id)
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
        $result = User::destroy($id);

        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with([ 'success' => "Запись id=[{$id}] удалена" ]);
        } else {
            return back()->withErrors([ 'msg' => 'Ошибка удаления' ]);
        }
    }

}
