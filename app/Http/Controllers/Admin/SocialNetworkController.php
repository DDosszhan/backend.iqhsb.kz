<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\SocialNetworkRepository;

class SocialNetworkController extends Controller
{
    use AdminBaseTrait;

    public function __construct(SocialNetworkRepository $socialNetworkRepository)
    {
        $this->repository = $socialNetworkRepository;

        $this->title = 'Ссылки на соц. сети';
        $this->titleCreate = 'Добавить ссылку';
        $this->titleEdit = 'Редактировать ссылку';
        $this->tableColumnCount = 4;

        $this->routeList = 'admin.social-networks.list';
        $this->routeCreate = 'admin.social-networks.create';
        $this->routeStore = 'admin.social-networks.store';
        $this->routeEdit = 'admin.social-networks.edit';
        $this->routeUpdate = 'admin.social-networks.update';
        $this->routeDelete = 'admin.social-networks.delete';

        $this->viewIndex = 'admin.social-networks.index';
        $this->viewList = 'admin.social-networks.list';
        $this->viewForm = 'admin.social-networks.form';
        $this->viewItem = 'admin.social-networks.item';
    }

    public function validationRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255', 'url'],
        ];
    }
}
