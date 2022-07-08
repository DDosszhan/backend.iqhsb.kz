<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\BannerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use StarterKit\Core\Repositories\BaseRepository;
use StarterKit\Core\Traits\AdminBase;

class BannerController extends Controller
{
    use AdminBase;

    protected BaseRepository $repository;

    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function setConfig(): array
    {
        return [
            'title' => [
                'list' => 'Баннеры страниц',
                'create' => 'Добавить баннер',
                'edit' => 'Редактировать баннер',
            ],
            'route' => [
                'list' => 'admin.banners.list',
                'create' => 'admin.banners.create',
                'store' => 'admin.banners.store',
                'edit' => 'admin.banners.edit',
                'update' => 'admin.banners.update',
                'delete' => 'admin.banners.delete',
            ],
            'view' => [
                'index' => 'admin.banners.index',
                'list' => 'admin.banners.list',
                'form' => 'admin.banners.form',
                'item' => 'admin.banners.item',
            ],
            'cropper' => [
                'aspectRatio' => 16 / 9,
            ],
        ];
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
            "button_url.$defaultLocale" => ['required', 'string', 'max:255'],
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
