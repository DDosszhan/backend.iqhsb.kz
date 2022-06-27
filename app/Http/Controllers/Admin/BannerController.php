<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\BannerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use AdminBaseTrait;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->repository = $bannerRepository;

        $this->title = 'Баннеры';
        $this->titleCreate = 'Добавить баннер';
        $this->titleEdit = 'Редактировать баннер';
        $this->tableColumnCount = 7;

        $this->routeList = 'admin.banners.list';
        $this->routeCreate = 'admin.banners.create';
        $this->routeStore = 'admin.banners.store';
        $this->routeEdit = 'admin.banners.edit';
        $this->routeUpdate = 'admin.banners.update';
        $this->routeDelete = 'admin.banners.delete';

        $this->viewIndex = 'admin.banners.index';
        $this->viewList = 'admin.banners.list';
        $this->viewForm = 'admin.banners.form';
        $this->viewItem = 'admin.banners.item';
    }

    public function validationRules(): array
    {
        $defaultLocale = app()->getLocale();
        $locales = implode(',', config('project.locales'));

        return [
            'title' => ['required', "array:$locales"],
            "title.$defaultLocale" => ['required', 'string', 'max:255'],
            'content' => ['required', "array:$locales"],
            "content.$defaultLocale" => ['required', 'string', 'max:255'],
            'button_text' => ['required', "array:$locales"],
            "button_text.$defaultLocale" => ['required', 'string', 'max:255'],
            'button_url' => ['required', "array:$locales"],
            "button_url.$defaultLocale" => ['required', 'string', 'max:255', 'url'],
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
