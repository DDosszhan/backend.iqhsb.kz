<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\UniversityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use StarterKit\Core\Traits\AdminBase;

class UniversityController extends Controller
{
    use AdminBase;

    public function __construct(UniversityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function setConfig(): array
    {
        return [
            'title' => [
                'list' => 'Университеты',
                'create' => 'Создать универститет',
                'edit' => 'Редактировать универститет',
            ],
            'route' => [
                'list' => 'admin.universities.list',
                'create' => 'admin.universities.create',
                'store' => 'admin.universities.store',
                'edit' => 'admin.universities.edit',
                'update' => 'admin.universities.update',
                'delete' => 'admin.universities.delete',
            ],
            'view' => [
                'index' => 'admin.universities.index',
                'list' => 'admin.universities.list',
                'form' => 'admin.universities.form',
                'item' => 'admin.universities.item',
            ],
            'cropper' => [
                'width' => 78,
                'height' => 78,
                'quality' => 1,
                'mimeType' => 'image/png',
                'extension' => 'png',
                'viewMode' => 0,
            ],
        ];
    }

    public function validationRules(): array
    {
        $defaultLocale = app()->getLocale();
        $locales = implode(',', config('project.locales'));

        return [
            'name' => ['required', "array:$locales"],
            "name.$defaultLocale" => ['required', 'string', 'max:255'],
            'cropper' => ['required', 'image'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $this->item = $this->repository->getModel()->create($validatedData);
        $this->item->addMedia($request->file('cropper'))->toMediaCollection('default');

        return $this->storeResponse();
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->item = $this->findById($id);

        $validatedData = $this->validateUpdateRequest($request->all());
        $this->item->update($validatedData);
        if ($request->hasFile('cropper')) {
            $this->item->addMedia($request->file('cropper'))->toMediaCollection('default');
        }

        return $this->updateResponse();
    }

    public function getValidationRulesForUpdate(): array
    {
        return array_merge($this->validationRules(), [
            'cropper' => ['nullable', 'image'],
        ]);
    }
}
