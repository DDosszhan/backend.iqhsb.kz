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
            'button_text' => ['nullable', "array:$locales"],
            "button_text.$defaultLocale" => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', "array:$locales"],
            "button_url.$defaultLocale" => ['nullable', 'string', 'max:255'],
            'cropper' => ['required', 'image'],
        ];
    }

    public function create()
    {
        $this->setConfig([
            'cropper' => [
                'width' => $this->item->getConfig('cropper_width'),
                'height' => $this->item->getConfig('cropper_height'),
                'quality' => 0.8,
            ],
            'banner' => [
                'hasContent' => $this->item->getConfig('has_content'),
                'hasButton' => $this->item->getConfig('has_button'),
            ],
        ]);
        return $this->createResponse();
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $validatedData['position'] = $this->repository->getLastPosition();
        $this->item = $this->repository->getModel()->create($validatedData);
        $this->item->addMedia($request->file('cropper'))->toMediaCollection('default');

        return $this->storeResponse();
    }

    public function edit(int $id): JsonResponse
    {
        $this->item = $this->findById($id);
        $this->setConfig([
            'cropper' => [
                'width' => $this->item->getConfig('cropper_width'),
                'height' => $this->item->getConfig('cropper_height'),
                'quality' => 0.8,
            ],
            'banner' => [
                'hasContent' => $this->item->getConfig('has_content'),
                'hasButton' => $this->item->getConfig('has_button'),
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

    public function list(): JsonResponse
    {
        $this->items = $this->repository->getModel()->orderBy('position')->paginate();

        return $this->listResponse();
    }

    public function storeResponse(): JsonResponse
    {
        return response()->json([
            'functions' => [
                'closeModal' => [
                    'params' => [
                        'modal' => 'largeModal',
                    ]
                ],
                'appendTableRow' => [
                    'params' => [
                        'selector' => '.ajax-content',
                        'content' => view($this->config('view.item'), [
                            'item' => $this->item,
                            'config' => $this->config(),
                        ])->render()
                    ]
                ]
            ]
        ]);
    }

    public function positionUp(int $id)
    {
        $items = $this->repository->getModel()->orderBy('position')->get();

        $position = 1;
        $skipId = null;
        $lastItemKey = count($items) - 1;
        foreach ($items as $k => $item) {
            if ($skipId == $item->id) {
                $position++;
                continue;
            }

            $item->position = $position;
            $item->save();

            if ($item->id == $id) {
                if ($position < count($items)) {
                    $item->position = $position - 1;
                    $item->save();
                }
                if (isset($items[$k - 1])) {
                    $items[$k - 1]->position = $position;
                    $items[$k - 1]->save();
                    $skipId = $items[$k - 1]->id;
                    if($k == $lastItemKey) {
                        $skipId = $items[$k - 1]->id;
                        $items[$k - 1]->position = $items[$k]->position;
                        $items[$k]->position = $position - 1;
                        $items[$k]->save();
                    }
                }
            }

            $position++;
        }
    }

    public function positionDown(int $id)
    {
        $items = $this->repository->getModel()->orderBy('position')->get();

        $position = 1;
        $skipId = null;
        foreach ($items as $k => $item) {
            if ($skipId == $item->id) {
                $position++;
                continue;
            }

            $item->position = $position;
            $item->save();

            if ($item->id == $id) {
                if ($position < count($items)) {
                    $item->position = $position + 1;
                    $item->save();
                }

                if (isset($items[$k + 1])) {
                    $items[$k + 1]->position = $position;
                    $items[$k + 1]->save();
                    $skipId = $items[$k + 1]->id;
                }
            }

            $position++;
        }
    }
}
