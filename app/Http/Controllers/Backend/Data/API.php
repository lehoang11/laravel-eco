<?php

$api = [
    'users' => [
        'show' => [
            'id', 'name', 'email', 'active', 'banned', 'country_code', 'created_at', 'updated_at'
        ],
        'enabled' => true,
    ],
    'users_settings' => [
        'show' => [
            'default_role', 'location', 'register_enabled', 'default_active', 'welcome_email'
        ],
        'enabled' => true,
    ],
    'roles' => [
        'show' => [
            'id', 'name', 'color', 'assignable', 'allow_editing', 'created_at', 'updated_at'
        ],
        'enabled' => true,
    ],
    'permissions' => [
        'show' => [
            'id', 'slug', 'color', 'assignable', 'created_at', 'updated_at'
        ],
        'enabled' => true,
    ],



    'documents' => [
        'show' => [
            'id', 'user_id', 'name', 'slug', 'disabled', 'download_timer', 'downloads', 'created_at', 'updated_at'
        ],
        'enabled' => true,
    ],

    'cates' => [
        'show' => [
            'id', 'name', 'alias','sort_order','parent_id', 'created_at', 'updated_at'
        ],
        'enabled' => true,
    ],
    'products' => [
        'show' => [
            'id', 'name', 'alias','cate_id','content','image','keywords', 'description', 'created_at', 'updated_at'
        ],
        'enabled' => true,
    ],
    
];
