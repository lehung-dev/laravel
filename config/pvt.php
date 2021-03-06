<?php

return [
    'admin' => [
        'prefix_admin'      => 'admin',
    ],
    'app' => [
        'prefix_news'       => 'news69',
    ],
    'format' => [
        'short_time'        => 'H:i d/m/Y',
        'long_time'         => 'd/m/Y',
    ],
    'template' => [
        'status' => [
            'all'           => ['name' => 'Tất cả',           'class' => 'btn-primary'],
            'active'        => ['name' => 'Kích hoạt',        'class' => 'btn-success'],
            'inactive'      => ['name' => 'Chưa kích hoạt',   'class' => 'btn-info'],
            'default'       => ['name' => 'Chưa xác định',    'class' => 'btn-info'],
        ],
        'is_home' => [
            0               => ['name' => 'Không hiển thị',     'class' => 'btn-warning'],
            1               => ['name' => 'Hiển thị',           'class' => 'btn-primary'],
        ],
        'display' => [
            'list'          => ['name' => 'Danh sách' ],
            'grid'          => ['name' => 'Lưới' ],
        ],
        'search' => [
            'all'           => ['name' => 'Search by All'],
            'id'            => ['name' => 'Search by ID'],
            'name'          => ['name' => 'Search by Name'],
            'username'      => ['name' => 'Search by Username'],
            'fullname'      => ['name' => 'Search by Fullname'],
            'email'         => ['name' => 'Search by Email'],
            'description'   => ['name' => 'Search by Description'],
            'link'          => ['name' => 'Search by Link'],
            'content'       => ['name' => 'Search by Content'],
        ],
        'button'    => [
            'edit'          => ['class' => 'btn-success',   'title' => 'Edit',      'icon' => 'fa-pencil',  'route-name' => '/form'],
            'delete'        => ['class' => 'btn-danger btn-delete',    'title' => 'Delete',    'icon' => 'fa-trash',   'route-name' => '/delete'],
            'info'          => ['class' => 'btn-info',      'title' => 'View',      'icon' => 'fa-pencil',  'route-name' => '/form'],
        ]
    ],
    'config'    =>  [
        'search'    =>  [
            'default'   =>   ['all', 'id', 'fullname'],
            'slider'    =>   ['all', 'id', 'name', 'description', 'link'],
            'category'    =>   ['all', 'id', 'name'],
        ]
    ]
];
