<?php

return [
    'name' => 'Управление блогом',
    'url' => 'blog',
    'roles_access' => [1, 2],
    'childs' => [
        [
            'name' => 'Категории',
            'url' => route('blog.admin.categories.index')
        ],
        [
            'name' => 'Записи',
            'url' => route('blog.admin.posts.index')
        ],
        [
            'name' => 'Комментарии',
            'url' => route('blog.admin.comments.index')
        ]
    ]
];
