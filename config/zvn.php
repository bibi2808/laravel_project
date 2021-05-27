<?php


return [
    'url' => [
        'prefix_admin' => 'admin',
        'prefix_dashboard' => 'dashboard',
        'prefix_news' => 'news',
    ],
    'format' => [
        'short_time' => 'd/m/Y',
        'long_time' => 'H:m:s d/m/Y',
    ],
    'template' => [
        'status' => [
            'ALL' => ['name' => 'Tất cả', 'class' => 'btn-success'],
            'active' => ['name' => 'Kích hoạt', 'class' => 'btn-success'],
            'Inactive' => ['name' => 'Chưa Kích hoạt', 'class' => 'btn-danger']
        ]
    ]
];