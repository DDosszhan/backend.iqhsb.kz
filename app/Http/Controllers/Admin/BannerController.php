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
                'list' => 'Баннер',
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
                'aspectRatio' => 1920 / 1080,
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
