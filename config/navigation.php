<?php

use StarterKit\Core\Ui\Attributes\LineAwesomeIcon;

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
                    'title' => 'Баннеры',
                    'route_name' => 'admin.banners.index',
                    'item_active_on' => 'iqanatcp/banners*',
                    'icon' => LineAwesomeIcon::IMAGE,
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Новости',
                    'route_name' => 'admin.news',
                    'item_active_on' => 'iqanatcp/news*',
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
                    'item_active_on' => 'iqanatcp/faqs*',
                    'icon' => 'la la-question-circle',
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Преподавательский состав',
                    'route_name' => 'admin.teachers.index',
                    'item_active_on' => 'iqanatcp/teachers*',
                    'icon' => LineAwesomeIcon::USER_PLUS,
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Попечители и партнеры',
                    'route_name' => 'admin.partners.index',
                    'item_active_on' => 'iqanatcp/partners*',
                    'icon' => LineAwesomeIcon::USER_PLUS,
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Достижения выпускников',
                    'route_name' => 'admin.graduate-achievements.index',
                    'item_active_on' => 'iqanatcp/graduate-achievements*',
                    'icon' => LineAwesomeIcon::USERS,
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Анкеты',
                    'route_name' => 'admin.questionnaires.index',
                    'item_active_on' => 'iqanatcp/questionnaires*',
                    'icon' => LineAwesomeIcon::USER_PLUS,
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Запросы консультации',
                    'route_name' => 'admin.consultation-requests.index',
                    'item_active_on' => 'iqanatcp/consultation-requests*',
                    'icon' => LineAwesomeIcon::USER_PLUS,
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Академический календарь',
                    'route_name' => 'admin.calendar-events.index',
                    'item_active_on' => 'iqanatcp/calendar-events*',
                    'icon' => LineAwesomeIcon::USER_PLUS,
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
        'settings' => [
            'title' => 'Настройки',
            'items' => [
                [
                    'is_tree' => false,
                    'title' => 'Локализация',
                    'route_name' => 'admin.settings.localisation',
                    'item_active_on' => 'iqanatcp/settings.localisation*',
                    'icon' => LineAwesomeIcon::TOGGLE_ON,
                    'roles' => [
                        'admin',
                        'manager',
                    ]
                ]
            ],
            'roles' => [
                'admin',
                'manager',
            ]
        ],
    ],
];
