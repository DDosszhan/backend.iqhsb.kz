<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PartnerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    use AdminBaseTrait;

    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->repository = $partnerRepository;

        $this->title = 'Попечители и партнеры';
        $this->titleCreate = 'Добавить партнера';
        $this->titleEdit = 'Редактировать партнера';
        $this->tableColumnCount = 7;

        $this->routeList = 'admin.partners.list';
        $this->routeCreate = 'admin.partners.create';
        $this->routeStore = 'admin.partners.store';
        $this->routeEdit = 'admin.partners.edit';
        $this->routeUpdate = 'admin.partners.update';
        $this->routeDelete = 'admin.partners.delete';

        $this->viewIndex = 'admin.partners.index';
        $this->viewList = 'admin.partners.list';
        $this->viewForm = 'admin.partners.form';
        $this->viewItem = 'admin.partners.item';
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
            'description' => ['required', "array:$locales"],
            "description.$defaultLocale" => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $this->item = $this->repository->create($validatedData);
        $this->item->addMedia($request->file('image'))->toMediaCollection('default');

        return $this->storeResponse();
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->item = $this->findById($id);

        $validatedData = $this->validateUpdateRequest($request->all());
        $this->item->update($validatedData);
        if ($request->hasFile('image')) {
            $this->item->addMedia($request->file('image'))->toMediaCollection('default');
        }

        return $this->updateResponse();
    }

    public function getValidationRulesForUpdate(): array
    {
        return array_merge($this->validationRules(), [
            'image' => ['nullable', 'image'],
        ]);
    }
}
