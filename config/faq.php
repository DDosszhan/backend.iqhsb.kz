<?php

return [
    'prefix' => 'admin/fag-groups',
    'middleware' => ['web', 'adminMiddleware'],
    'guard' => 'admins',
    'pagination' => [
        'faqs' => 10,
        'groups' => 9,
    ],


    'locales' => ['ru', 'en', 'kk'],

    'routes' => [
        'index' => [
            'name' => 'admin.faq.groups',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'index',
            'request_type' => 'get',
            'uri' => '/',
        ],

        'list' => [
            'name' =>'admin.faq.list',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'getList',
            'request_type' => 'get',
            'uri' => 'list',
        ],

        'create' => [
            'name' => 'admin.faq.create',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'create',
            'request_type' => 'get',
            'uri' => 'create',
        ],

        'store' => [
            'name' => 'admin.faq.store',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'store',
            'request_type' => 'post',
            'uri' => 'store',
        ],

        'edit' => [
            'name' => 'admin.faq.edit',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'edit',
            'uri' => '{id}/edit',
            'request_type' => 'get',
        ],


        'update' => [
            'name' => 'admin.faq.update',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'update',
            'uri' => '{id}/update',
            'request_type' => 'post',
        ],

        'delete' => [
            'name' => 'admin.faq.delete',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'delete',
            'uri' => '{id}/delete',
            'request_type' => 'get',
        ],

        'down' => [
            'name' => 'admin.faq.position.down',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'positionDown',
            'uri' => '{categoryId}/group/{id}/down',
            'request_type' => 'get',
        ],

        'up' => [
            'name' => 'admin.faq.position.up',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'positionUp',
            'uri' => '{categoryId}/group/{id}/up',
            'request_type' => 'get',
        ],

        'media' => [
            'name' => 'admin.faq.media',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'media',
            'request_type' => 'post',
            'uri' => '{faqId}/media',
        ],

        'deleteMedia' => [
            'name' => 'admin.faq.delete.media',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'deleteMedia',
            'request_type' => 'get',
            'uri' => '{faqId}/delete-media',
        ],

        'mainMedia' => [
            'name' => 'admin.faq.main.media',
            'controller' => \StarterKit\Faq\Http\Controllers\FaqController::class,
            'method' => 'mainMedia',
            'uri' => '{faqId}/{mediaId}/main-media',
            'request_type' => 'get',
        ],

        'questions-index' => [
            'name' => 'admin.questions',
            'controller' => \StarterKit\Faq\Http\Controllers\QuestionsController::class,
            'method' => 'index',
            'request_type' => 'get',
            'uri' => '{groupId}/questions',
        ],

        'questions-list' => [
            'name' =>'admin.questions.list',
            'controller' => \StarterKit\Faq\Http\Controllers\QuestionsController::class,
            'method' => 'getList',
            'request_type' => 'get',
            'uri' => '{groupId}/questions/list',
        ],

        'questions-create' => [
            'name' => 'admin.questions.create',
            'controller' => \StarterKit\Faq\Http\Controllers\QuestionsController::class,
            'method' => 'create',
            'request_type' => 'get',
            'uri' => '{groupId}/questions/create',
        ],

        'questions-store' => [
            'name' => 'admin.questions.store',
            'controller' => \StarterKit\Faq\Http\Controllers\QuestionsController::class,
            'method' => 'store',
            'request_type' => 'post',
            'uri' => '{groupId}/questions/store',
        ],

        'questions-edit' => [
            'name' => 'admin.questions.edit',
            'controller' => \StarterKit\Faq\Http\Controllers\QuestionsController::class,
            'method' => 'edit',
            'uri' => '{groupId}/questions/{id}/edit',
            'request_type' => 'get',

        ],

        'questions-update' => [
            'name' => 'admin.questions.update',
            'controller' => \StarterKit\Faq\Http\Controllers\QuestionsController::class,
            'method' => 'update',
            'uri' => '{groupId}/questions/{id}/update',
            'request_type' => 'post',
        ],

        'questions-delete' => [
            'name' => 'admin.questions.delete',
            'controller' => \StarterKit\Faq\Http\Controllers\QuestionsController::class,
            'method' => 'delete',
            'uri' => '{groupId}/questions/{id}/delete',
            'request_type' => 'get',
        ],

        'questions-down' => [
            'name' => 'admin.questions.position.down',
            'controller' => \StarterKit\Faq\Http\Controllers\QuestionsController::class,
            'method' => 'positionDown',
            'uri' => '{groupId}/questions/{id}/down',
            'request_type' => 'get',

        ],

        'questions-up' => [
            'name' => 'admin.questions.position.up',
            'controller' => \StarterKit\Faq\Http\Controllers\QuestionsController::class,
            'method' => 'positionUp',
            'uri' => '{groupId}/questions/{id}/up',
            'request_type' => 'get',
        ],
    ],

    'views' => [
        'groupsFaq' => [
            'index' => 'faq::index',
            'list' => 'faq::list',
            'item' => 'faq::item',
            'form' => 'faq::form',
            'media_list' => 'faq::media.media_list',
            'media_item' => 'faq::media.media_item'
        ],
        'questions' => [
            'index' => 'faq::questions/index',
            'list' => 'faq::questions/list',
            'item' => 'faq::questions/item',
            'form' => 'faq::questions/form',
        ],
    ],
];
