<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PartnerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use StarterKit\Core\Traits\AdminBase;

class PartnerController extends Controller
{
    use AdminBase;

    public function __construct(PartnerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Попечители и партнеры',
                'create' => 'Добавить партнера',
                'edit' => 'Редактировать партнера',
            ],
            'route' => [
                'list' => 'admin.partners.list',
                'create' => 'admin.partners.create',
                'store' => 'admin.partners.store',
                'edit' => 'admin.partners.edit',
                'update' => 'admin.partners.update',
                'delete' => 'admin.partners.delete',
            ],
            'view' => [
                'index' => 'admin.partners.index',
                'list' => 'admin.partners.list',
                'form' => 'admin.partners.form',
                'item' => 'admin.partners.item',
            ],
            'cropper' => [
                'width' => 180,
                'height' => 180,
                'quality' => 1,
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
            'company' => ['required', "array:$locales"],
            "company.$defaultLocale" => ['required', 'string', 'max:255'],
            'description' => ['nullable', "array:$locales"],
            "description.$defaultLocale" => ['nullable', 'string', 'max:255'],
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
