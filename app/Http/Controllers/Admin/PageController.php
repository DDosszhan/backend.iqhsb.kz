<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use StarterKit\Core\Traits\AdminBase;

class PageController extends Controller
{
    use AdminBase;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;

        $this->title = 'Страницы';
        $this->titleCreate = 'Добавить страницу';
        $this->titleEdit = 'Редактировать страницу';
        $this->tableColumnCount = 20;

        $this->routeList = 'admin.pages.list';
        $this->routeCreate = 'admin.pages.create';
        $this->routeStore = 'admin.pages.store';
        $this->routeEdit = 'admin.pages.edit';
        $this->routeUpdate = 'admin.pages.update';
        $this->routeDelete = 'admin.pages.delete';

        $this->viewIndex = 'admin.pages.index';
        $this->viewList = 'admin.pages.list';
        $this->viewForm = 'admin.pages.form';
        $this->viewItem = 'admin.pages.item';
    }

    public function validationRules(): array
    {
        $defaultLocale = Lang::getLocale();
        $locales = implode(',', config('project.locales'));

        return [
            'title' => ['required', "array:$locales"],
            "title.$defaultLocale" => ['required', 'string', 'max:255'],
            'content' => ['required', "array:$locales"],
            "content.$defaultLocale" => ['required', 'string', 'max:65535'],
            'blocks' => ['nullable', 'array'],
            'blocks.*.title' => ['nullable', "array:$locales"],
            "blocks.*.title.$defaultLocale" => ['nullable', 'string', 'max:255'],
            'blocks.*.content' => ['nullable', "array:$locales"],
            "blocks.*.content.$defaultLocale" => ['nullable', 'string', 'max:65535'],
            'image' => ['required', 'image'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $this->item = $this->repository->getModel()->create($validatedData);
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
