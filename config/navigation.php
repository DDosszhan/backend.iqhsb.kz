<?php

return [
    'sections' => [
        'manage' => [
            'title' => 'Администрирование',
            'items' => [
                [
                    'is_tree' => false,
                    'title' => 'Администраторы',
                    'route_name' => 'admin.admins',
                    'item_active_on' => 'admin/admins*',
                    'icon' => 'la la-users',
                    'roles' => [
                        'admin'
                    ]
                ]
            ],
            'roles' => [
                'admin'
            ]
        ],

        'modules' => [
            'title' => 'Модули',
            'items' => [
                [
                    'is_tree' => false,
                    'title' => 'Новости',
                    'route_name' => 'admin.news',
                    'item_active_on' => 'admin/news',
                    'icon' => 'la la-bullhorn',
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Частые вопросы',
                    'route_name' => 'admin.faqs.index',
                    'item_active_on' => 'admin/faqs*',
                    'icon' => 'la la-question-circle',
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
            ],
            'roles' => [
                'admin',
                'manager'
            ]
        ],

        'reports' => [
            'title' => 'Модерация',
            'items' => [

            ],
            'roles' => [
                'admin',
                'manager'
            ]
        ],
    ],
];
