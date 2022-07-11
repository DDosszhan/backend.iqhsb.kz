<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\BannerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use StarterKit\Core\Traits\AdminBase;

class BannerController extends Controller
{
    use AdminBase;

    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
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
        ];
    }

    public function validationRules(): array
    {
        $defaultLocale = app()->getLocale();
        $locales = implode(',', config('project.locales'));

        return [
            'title' => ['required', "array:$locales"],
            "title.$defaultLocale" => ['required', 'string', 'max:255'],
            'content' => ['nullable', "array:$locales"],
            "content.$defaultLocale" => ['nullable', 'string', 'max:1024'],
            'button_text' => ['required', "array:$locales"],
            "button_text.$defaultLocale" => ['required', 'string', 'max:255'],
            'button_url' => ['required', "array:$locales"],
            "button_url.$defaultLocale" => ['required', 'string', 'max:255'],
            'cropper' => ['required', 'image'],
        ];
    }

    public function create()
    {
        $this->setConfig([
            'cropper' => [
                'width' => $this->item->settings['cropper_width'],
                'height' => $this->item->settings['cropper_height'],
                'quality' => 0.8,
            ],
            'banner' => [
                'hasContent' => $this->item->settings['has_content'],
            ],
        ]);
        return $this->createResponse();
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $this->item = $this->repository->getModel()->create($validatedData);
        $this->item->addMedia($request->file('cropper'))->toMediaCollection('default');

        return $this->storeResponse();
    }

    public function edit(int $id): JsonResponse
    {
        $this->item = $this->findById($id);
        $this->setConfig([
            'cropper' => [
                'width' => $this->item->settings['cropper_width'],
                'height' => $this->item->settings['cropper_height'],
                'quality' => 0.8,
            ],
            'banner' => [
                'hasContent' => $this->item->settings['has_content'],
            ],
        ]);
        return $this->editResponse();
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
