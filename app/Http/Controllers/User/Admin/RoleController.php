<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use App\Repositories\RoleRepository;

class RoleController extends BaseController {

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * RoleController constructor.
     */
    public function __construct () {
        parent::__construct();

        $this->roleRepository = app(RoleRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $paginator = $this->roleRepository->getAllWithPaginate();

        return view('user.admin.roles.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $item = new Role();
        $roleList = $this->roleRepository->getForComboBox();

        return view('user.admin.roles.edit', compact('item', 'roleList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request) {
        $data = $request->input();
        $item = (new Role())->create($data);

        if ($item) {
            return redirect()->route('admin.roles.edit', [$item->id])
                ->with(['success' => 'Успешно сохранен']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $item = $this->roleRepository->getEdit($id);

        if (!$item) {
            abort(404);
        }

        $roleList = $this->roleRepository->getForComboBox();

        return view('user.admin.roles.edit', compact('item', 'roleList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleUpdateRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id) {
        $item = $this->roleRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors([ 'msg' => "Запись id=[{$id}] не найдена" ])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.roles.edit', $item->id)
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
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id) {
        $result = Role::destroy($id);

        if ($result) {
            return redirect()
                ->route('admin.roles.index')
                ->with([ 'success' => "Запись id=[{$id}] удалена" ]);
        } else {
            return back()->withErrors([ 'msg' => 'Ошибка удаления' ]);
        }
    }

}
