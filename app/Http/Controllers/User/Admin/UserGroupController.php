<?php

namespace App\Http\Controllers\User\Admin;

use App\Models\UserGroup;
use App\Repositories\UserGroupRepository;
use Illuminate\Http\Request;

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
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        dd(__METHOD__);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserGroup $userGroup) {
        dd(__METHOD__);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGroup $userGroup) {
        dd(__METHOD__);
    }
}
