<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ConsultationRequestRepository;

class ConsultationRequestController extends Controller
{
    use AdminBaseTrait;

    public function __construct(ConsultationRequestRepository $consultationRequestRepository)
    {
        $this->repository = $consultationRequestRepository;

        $this->title = 'Запросы консультации';
        $this->titleCreate = 'Создать запрос консультации'; // lol
        $this->titleEdit = 'Редактировать запрос консультации';
        $this->tableColumnCount = 6;

        $this->routeList = 'admin.consultation-requests.list';
        $this->routeCreate = 'admin.consultation-requests.create';
        $this->routeStore = 'admin.consultation-requests.store';
        $this->routeEdit = 'admin.consultation-requests.edit';
        $this->routeUpdate = 'admin.consultation-requests.update';
        $this->routeDelete = 'admin.consultation-requests.delete';

        $this->viewIndex = 'admin.consultation-requests.index';
        $this->viewList = 'admin.consultation-requests.list';
        $this->viewForm = 'admin.consultation-requests.form';
        $this->viewItem = 'admin.consultation-requests.item';
    }

    public function validationRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}
