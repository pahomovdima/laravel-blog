<?php

namespace App\Http\Controllers\User\Admin;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController {

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var array
     */
    private $validRulesWithPassword = [
        'name' => 'required|min:5|max:200',
        'email' => 'required|email',
        'password' => 'required|string|min:8|confirmed',
        'role_id' => 'required|integer|exists:roles,id'
    ];

    /**
     * UserController constructor.
     */
    public function __construct () {
        parent::__construct();

        $this->userRepository = app(UserRepository::class);
        $this->roleRepository = app(RoleRepository::class);
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
        $roleList = $this->roleRepository->getForComboBox();

        return view('user.admin.users.edit', compact('item', 'roleList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store (UserCreateRequest $request) {
        $data = $request->input();

        $item = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

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

        $roleList = $this->roleRepository->getForComboBox();

        return view('user.admin.users.edit', compact('item', 'roleList'));
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update (UserUpdateRequest $request, $id) {
        $item = $this->userRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors([ 'msg' => "Запись id=[{$id}] не найдена" ])
                ->withInput();
        }

        $data = $request->all();
        if ($data['password']) {
            $this->validate($request, $this->validRulesWithPassword);
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $item->password;
        }

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
