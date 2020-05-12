<?php

namespace App\Http\Controllers\Admin;

class AdminController extends BaseController {

    /**
     * @var array
     */
    private $mainMenu;

    /**
     * AdminController constructor.
     */
    public function __construct () {
        $this->mainMenu = [
            [
                'name' => 'Управление блогом',
                'url' => 'blog',
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
            ],
            [
                'name' => 'Пользователи',
                'url' => 'user',
                'childs' => [
                    [
                        'name' => 'Управление пользователями',
                        'url' => '/admin/user/users'
                    ],
                    [
                        'name' => 'Управление группами пользователей',
                        'url' => '/admin/user/user_groups'
                    ]
                ]
            ]
        ];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index () {
        $menu = $this->mainMenu;

        return view('admin.index', compact('menu'));
    }

}
