<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PageRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use StarterKit\Core\Traits\AdminBase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    use AdminBase;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Страницы',
                'create' => 'Добавить страницу',
                'edit' => 'Редактировать страницу',
            ],
            'route' => [
                'list' => 'admin.pages.list',
                'create' => 'admin.pages.create',
                'store' => 'admin.pages.store',
                'edit' => 'admin.pages.edit',
                'update' => 'admin.pages.update',
                'delete' => 'admin.pages.delete',
            ],
            'view' => [
                'index' => 'admin.pages.index',
                'list' => 'admin.pages.list',
                'form' => 'admin.pages.form',
                'item' => 'admin.pages.item',
            ],
        ];
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
            'image' => ['nullable', 'image'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $this->item = $this->repository->getModel()->create(array_merge($validatedData, [
            'settings' => [
                'block_count' => 0,
                'removable' => true,
            ],
        ]));

        if ($request->hasFile('image')) {
            $this->item->addMedia($request->file('image'))->toMediaCollection('default');
        }

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
