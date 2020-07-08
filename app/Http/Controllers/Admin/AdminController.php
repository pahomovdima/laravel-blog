<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminController extends BaseController {

    private $mainMenu;
    private $blogMenu;
    private $userMenu;

    /**
     * AdminController constructor.
     */
    public function __construct () {
        $this->userMenu = include 'menu_array_user.php';
        $this->blogMenu = include 'menu_array_blog.php';
    }

    /**
     * @param int $userRole
     * @return array
     */
    protected function getMenu (int $userRole) {
        foreach ([$this->blogMenu, $this->userMenu] as $menu) {
            if (in_array($userRole, $menu['roles_access'])) {
                $this->mainMenu[] = $menu;
            }
        }

        return $this->mainMenu;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index (Request $request) {
        $menu = $this->getMenu($request->user()->role_id);

        if ($menu) {
            return view('admin.index', compact('menu'));
        } else {
            return view('home');
        }
    }

}
