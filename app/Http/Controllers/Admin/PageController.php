<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Spatie\Image\Image;
use StarterKit\Core\Exceptions\ItemNotFoundException;
use StarterKit\Core\Traits\AdminBase;

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
                'deleteMedia' => 'admin.pages.deleteMedia',
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
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['nullable', 'image'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $this->item = $this->repository->getModel()->create(array_merge($validatedData, [
            'settings' => [
                'has_gallery' => false,
                'block_count' => 0,
                'removable' => true,
            ],
        ]));

        if ($request->hasFile('gallery')) {
            $this->item->addMultipleMediaFromRequest(['gallery'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('gallery');
            });
        }

        return $this->storeResponse();
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->item = $this->findById($id);

        $validatedData = $this->validateUpdateRequest($request->all());
        $this->item->update($validatedData);
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $uploadedFile) {
                if ($width = $this->item->getConfig('gallery_width')) {
                    Image::load($uploadedFile->getRealPath())->width($width)->save();
                }
                $this->item->addMedia($uploadedFile)->toMediaCollection('gallery');
            }
        }

        return $this->updateResponse();
    }

    public function getValidationRulesForUpdate(): array
    {
        return array_merge($this->validationRules(), [
            'image' => ['nullable', 'image'],
        ]);
    }

    public function deleteMedia(int $id, int $mediaId): JsonResponse
    {
        $media = $this->findById($id)->getMedia('gallery')->where('id', $mediaId)->first();
        if (!$media) {
            throw new ItemNotFoundException("Медиа не найдено в галерее с id ='$mediaId'");
        }
        $media->delete();

        return response()->json([
            'functions' => [
                'removeMediaFromGallery' => [
                    'params' => [
                        'selector' => '#gallery-media-' . $media->id,
                    ]
                ]
            ]
        ]);
    }
}
