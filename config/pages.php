<?php

return [
    'prefix' => 'iqanatcp/pages',
    'middleware' => ['web', 'adminMiddleware'],
    'guard' => 'admins',


    'routes' => [
        'index' => [
            'name' => 'admin.pages',
            'controller' => \StarterKit\Pages\Http\Controllers\PageController::class,
            'method' => 'index',
            'request_type' => 'get',
            'uri' => '/',

            ],

        'list' => [
            'name' =>'admin.pages.list',
            'controller' => \StarterKit\Pages\Http\Controllers\PageController::class,
            'method' => 'getList',
            'request_type' => 'get',
            'uri' => 'list',

        ],

        'create' => [
            'name' => 'admin.pages.create',
            'controller' => \StarterKit\Pages\Http\Controllers\PageController::class,
            'method' => 'create',
            'request_type' => 'get',
            'uri' => 'create',


        ],

        'store' => [
            'name' => 'admin.pages.store',
            'controller' => \StarterKit\Pages\Http\Controllers\PageController::class,
            'method' => 'store',
            'request_type' => 'post',
            'uri' => 'store',


        ],

        'edit' => [
            'name' => 'admin.pages.edit',
            'controller' => \StarterKit\Pages\Http\Controllers\PageController::class,
            'method' => 'edit',
            'uri' => '{id}/edit',
            'request_type' => 'get',

        ],


        'update' => [
            'name' => 'admin.pages.update',
            'controller' => \StarterKit\Pages\Http\Controllers\PageController::class,
            'method' => 'update',
            'uri' => '{id}/update',
            'request_type' => 'post',

        ],

        'delete' => [
            'name' => 'admin.pages.delete',
            'controller' => \StarterKit\Pages\Http\Controllers\PageController::class,
            'method' => 'delete',
            'uri' => '{id}/delete',
            'request_type' => 'get',

        ]
    ],

    'views' => [

    ],


];
