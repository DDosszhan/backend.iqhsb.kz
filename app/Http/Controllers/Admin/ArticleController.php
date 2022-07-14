<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ArticleRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use StarterKit\Core\Traits\AdminBase;

class ArticleController extends Controller
{
    use AdminBase;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Новости',
                'create' => 'Добавить новость',
                'edit' => 'Редактировать новость',
            ],
            'route' => [
                'list' => 'admin.articles.list',
                'create' => 'admin.articles.create',
                'store' => 'admin.articles.store',
                'edit' => 'admin.articles.edit',
                'update' => 'admin.articles.update',
                'delete' => 'admin.articles.delete',
            ],
            'view' => [
                'index' => 'admin.articles.index',
                'list' => 'admin.articles.list',
                'form' => 'admin.articles.form',
                'item' => 'admin.articles.item',
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
        $defaultLocale = Lang::getLocale();
        $locales = implode(',', config('project.locales'));

        return [
            'title' => ['required', "array:$locales"],
            "title.$defaultLocale" => ['required', 'string', 'max:255'],
            'content' => ['required', "array:$locales"],
            "content.$defaultLocale" => ['required', 'string', 'max:65535'],
            'active' => ['sometimes', 'nullable', 'accepted'],
            'published_at' => ['nullable', 'date_format:d.m.Y H:i'],
            'cropper' => ['required', 'image'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $validatedData['active'] = isset($validatedData['active']);
        $validatedData['published_at'] = $validatedData['published_at'] ? Carbon::parse($validatedData['published_at'])->toDateTimeString() : Carbon::now()->toDateTimeString();
        $this->item = $this->repository->getModel()->create($validatedData);
        $this->item->addMedia($request->file('cropper'))->toMediaCollection('default');

        return $this->storeResponse();
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->item = $this->findById($id);

        $validatedData = $this->validateUpdateRequest($request->all());
        $validatedData['active'] = isset($validatedData['active']);
        $validatedData['published_at'] = $validatedData['published_at'] ? Carbon::parse($validatedData['published_at'])->toDateTimeString() : Carbon::now()->toDateTimeString();
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
