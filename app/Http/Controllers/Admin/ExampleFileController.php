<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ExampleFileRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use StarterKit\Core\Traits\AdminBase;

class ExampleFileController extends Controller
{
    use AdminBase;

    public function __construct(ExampleFileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Файлы',
                'create' => 'Добавить Файл',
                'edit' => 'Редактировать Файл',
            ],
            'route' => [
                'list' => 'admin.example_files.list',
                'create' => 'admin.example_files.create',
                'store' => 'admin.example_files.store',
                'edit' => 'admin.example_files.edit',
                'update' => 'admin.example_files.update',
                'delete' => 'admin.example_files.delete',
            ],
            'view' => [
                'index' => 'admin.example_files.index',
                'list' => 'admin.example_files.list',
                'form' => 'admin.example_files.form',
                'item' => 'admin.example_files.item',
            ],
            'cropper' => [
                'width' => 1280,
                'height' => 720,
                'quality' => 0.8,
            ],
        ];
    }

    public function validationRules(): array
    {
        return [
//            'name' => ['required', 'string', 'max:255'],
            'example_file' => ['required', 'file'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $this->item = $this->repository->getModel()->create($validatedData);
        $this->item->addMedia($request->file('example_file'))->toMediaCollection('default');

        return $this->storeResponse();
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->item = $this->findById($id);

        $validatedData = $this->validateUpdateRequest($request->all());
        $this->item->update($validatedData);
        $this->item->addMedia($request->file('example_file'))->toMediaCollection('default');

        return $this->updateResponse();
    }
}
