<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminController extends BaseController {

    /**
     * @var array
     */
    private $mainMenu;

    /**
     * @var array
     */
    private $blogMenu = [
        'name' => 'Управление блогом',
        'url' => 'blog',
        'groups_access' => [1, 2],
        'childs' => [
            [
                'name' => 'Категории',
                'url' => '/admin/blog/categories'
            ],
            [
                'name' => 'Записи',
                'url' => '/admin/blog/posts'
            ]
        ]
    ];

    /**
     * @var array
     */
    private $userMenu = [
        'name' => 'Пользователи',
        'url' => 'user',
        'groups_access' => [1],
        'childs' => [
            [
                'name' => 'Пользователи',
                'url' => '/admin/user/users'
            ],
            [
                'name' => 'Группы пользователей',
                'url' => '/admin/user/user_groups'
            ]
        ]
    ];

    /**
     * @param int $userGroup
     * @return array
     */
    protected function getMenu (int $userGroup) {
        foreach ([$this->blogMenu, $this->userMenu] as $menu) {
            if (in_array($userGroup, $menu['groups_access'])) {
                $this->mainMenu[] = $menu;
            }
        }

        return $this->mainMenu;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index (Request $request) {
        $menu = $this->getMenu($request->user()->group_id);

        if ($menu) {
            return view('admin.index', compact('menu'));
        } else {
            return view('home');
        }
    }

}
