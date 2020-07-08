<?php

return [
    'name' => 'Пользователи',
    'url' => 'user',
    'roles_access' => [1],
    'childs' => [
        [
            'name' => 'Пользователи',
            'url' => route('admin.users.index')
        ],
        [
            'name' => 'Роли пользователей',
            'url' => route('admin.roles.index')
        ]
    ]
];
