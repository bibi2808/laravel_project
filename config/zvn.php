<?php


return [
    'url' => [
        'prefix_admin'      => 'admin',
        'prefix_dashboard'  => 'dashboard',
        'prefix_dashboard'  => 'category',
        'prefix_news'       => 'hot-new',
    ],
    'format' => [
        'short_time'        => 'd/m/Y',
        'long_time'         => 'H:m:s d/m/Y',
    ],
    'template' => [
        'form_label' => [
            'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        ],
        'form_input' => [
            'class' => 'form-control col-md-6 col-xs-12'
        ],
        'form_ckeditor' => [
            'class' => 'form-control col-md-6 col-xs-12 ckeditor'
        ],
        'status' => [
            'all'           => ['name' => 'ALL', 'class' => 'btn-success'],
            'active'        => ['name' => 'Active', 'class' => 'btn-success'],
            'inactive'      => ['name' => 'Inactive', 'class' => 'btn-danger'],
            'default'       => ['name' => 'Default', 'class' => 'btn-danger'],
            'block'         => ['name' => 'block', 'class' => 'btn-danger']
        ],
        'is_home' => [
            'yes'           => ['name' => 'Show', 'class' => 'btn-primary'],
            'no'            => ['name' => 'Hile', 'class' => 'btn-warning'],
        ],
        'display' => [
            'list'           => ['name' => 'List'],
            'grid'           => ['name' => 'Grid'],
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
        'button' => [
            'edit'      => ['class' => 'btn-success',  'title'  => 'Edit',      'icon' => 'fa-pencil',   'route-name' => '/form'],
            'delete'    => ['class' => 'btn-danger btn-delete',   'title'  => 'Delete',    'icon' => 'fa-trash',    'route-name' => '/delete'],
            'info'      => ['class' => 'btn-info',     'title'  => 'Info',      'icon' => 'fa-pencil',   'route-name' => '/delete'],
        ]
    ],
    'config' => [
        'search' => [
            'slider' => ['all', 'id', 'name', 'description', 'link'],
            'category' => ['all', 'id', 'name'],
            'article' => ['all', 'id', 'name'],
            'default' => ['all', 'id']
        ],
        'button' => [
            'default'       => ['edit', 'delete'],
            'slider'        => ['edit', 'delete'],
            'category'      => ['edit', 'delete'],
            'article'       => ['edit', 'delete']
        ]
    ]
];
