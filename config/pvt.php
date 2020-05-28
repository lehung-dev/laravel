<?php

return [
    'admin' => [
        'prefix_admin'      => 'admin',
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
        ]
    ]
];
