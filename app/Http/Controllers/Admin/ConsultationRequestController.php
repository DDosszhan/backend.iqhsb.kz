<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ConsultationRequestsExport;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\ConsultationRequestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use StarterKit\Core\Traits\AdminBase;

class ConsultationRequestController extends Controller
{
    use AdminBase;

    private Excel $excel;

    public function __construct(ConsultationRequestRepository $repository, Excel $excel)
    {
        $this->repository = $repository;
        $this->excel = $excel;
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
                'index' => 'admin.consultation-requests.index',
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

    public function list(Request $request): JsonResponse
    {
        $this->items = $this->repository->order('created_at', 'desc')->withDataFilter($request);
        return $this->listResponse();
    }

    public function export()
    {
        return $this->excel->download(new ConsultationRequestsExport, 'consultation-requests.xlsx');
    }
}
