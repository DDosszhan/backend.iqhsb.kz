<?php

use StarterKit\Core\Ui\Attributes\LineAwesomeIcon;

$prefix = 'iqanatcp';

return [
    'sections' => [
        'manage' => [
            'title' => 'Администрирование',
            'items' => [
                [
                    'is_tree' => false,
                    'title' => 'Администраторы',
                    'route_name' => 'admin.admins',
                    'item_active_on' => "$prefix/admins*",
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
                    'item_active_on' => "$prefix/news*",
                    'icon' => 'la la-bullhorn',
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => true,
                    'title' => 'Контент',
                    'item_active_on' => "$prefix/pages*",
                    'icon' => LineAwesomeIcon::BOOK,
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                    'children' => [
                        [
                            'is_tree' => false,
                            'title' => 'Домашняя',
                            'route_name' => 'admin.pages.show',
                            'route_params' => [
                                'page' => 'home',
                            ],
                            'item_active_on' => "$prefix/pages/home*",
                            'icon' => '',
                            'roles' => [
                                'admin',
                                'manager',
                            ],
                        ],
                        [
                            'is_tree' => false,
                            'title' => 'Программы',
                            'route_name' => 'admin.pages.show',
                            'route_params' => [
                                'page' => 'program',
                            ],
                            'item_active_on' => "$prefix/pages/program*",
                            'icon' => '',
                            'roles' => [
                                'admin',
                                'manager',
                            ],
                        ],
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Баннеры страниц',
                    'route_name' => 'admin.banners.index',
                    'item_active_on' => "$prefix/banners*",
                    'icon' => LineAwesomeIcon::IMAGE,
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Частые вопросы',
                    'route_name' => 'admin.faqs.index',
                    'item_active_on' => "$prefix/faqs*",
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
                    'item_active_on' => "$prefix/teachers*",
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
                    'item_active_on' => "$prefix/partners*",
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
                    'item_active_on' => "$prefix/graduate-achievements*",
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
                    'item_active_on' => "$prefix/questionnaires*",
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
                    'item_active_on' => "$prefix/consultation-requests*",
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
                    'item_active_on' => "$prefix/calendar-events*",
                    'icon' => LineAwesomeIcon::USER_PLUS,
                    'roles' => [
                        'admin',
                        'manager',
                    ],
                ],
                [
                    'is_tree' => false,
                    'title' => 'Ссылки на соц. сети',
                    'route_name' => 'admin.social-networks.index',
                    'item_active_on' => "$prefix/social-networks*",
                    'icon' => LineAwesomeIcon::EXTERNAL_LINK,
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
                    'item_active_on' => "$prefix/settings.localisation*",
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
