<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ConsultationRequestRepository;
use StarterKit\Core\Traits\AdminBase;

class ConsultationRequestController extends Controller
{
    use AdminBase;

    public function __construct(ConsultationRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Запросы консультации',
                'create' => 'Создать запрос консультации',
                'edit' => 'Редактировать запрос консультации',
            ],
            'route' => [
                'list' => 'admin.consultation-requests.list',
                'create' => 'admin.consultation-requests.create',
                'store' => 'admin.consultation-requests.store',
                'edit' => 'admin.consultation-requests.edit',
                'update' => 'admin.consultation-requests.update',
                'delete' => 'admin.consultation-requests.delete',
            ],
            'view' => [
                'index' => 'admin.consultation-requests.index',
                'list' => 'admin.consultation-requests.list',
                'form' => 'admin.consultation-requests.form',
                'item' => 'admin.consultation-requests.item',
            ],
        ];
    }

    public function validationRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}
