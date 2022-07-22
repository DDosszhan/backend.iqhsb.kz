<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\SocialNetworkRepository;
use StarterKit\Core\Traits\AdminBase;

class SocialNetworkController extends Controller
{
    use AdminBase;

    public function __construct(SocialNetworkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Ссылки на соц. сети',
                'create' => 'Добавить ссылку',
                'edit' => 'Редактировать ссылку',
            ],
            'route' => [
                'list' => 'admin.social-networks.list',
                'create' => 'admin.social-networks.create',
                'store' => 'admin.social-networks.store',
                'edit' => 'admin.social-networks.edit',
                'update' => 'admin.social-networks.update',
                'delete' => 'admin.social-networks.delete',
            ],
            'view' => [
                'index' => 'admin.social-networks.index',
                'list' => 'admin.social-networks.list',
                'form' => 'admin.social-networks.form',
                'item' => 'admin.social-networks.item',
            ],
        ];
    }

    public function validationRules(): array
    {
        return [
//            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:1024', 'url'],
        ];
    }
}
