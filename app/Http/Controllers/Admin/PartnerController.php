<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PartnerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use StarterKit\Core\Traits\AdminBase;

class PartnerController extends Controller
{
    use AdminBase;

    public function __construct(PartnerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Попечители и партнеры',
                'create' => 'Добавить партнера',
                'edit' => 'Редактировать партнера',
            ],
            'route' => [
                'list' => 'admin.partners.list',
                'create' => 'admin.partners.create',
                'store' => 'admin.partners.store',
                'edit' => 'admin.partners.edit',
                'update' => 'admin.partners.update',
                'delete' => 'admin.partners.delete',
            ],
            'view' => [
                'index' => 'admin.partners.index',
                'list' => 'admin.partners.list',
                'form' => 'admin.partners.form',
                'item' => 'admin.partners.item',
            ],
            'cropper' => [
                'width' => 180,
                'height' => 180,
                'quality' => 1,
            ],
        ];
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
            'description' => ['nullable', "array:$locales"],
            "description.$defaultLocale" => ['nullable', 'string', 'max:255'],
            'cropper' => ['required', 'image'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $validatedData['position'] = $this->repository->getLastPosition();
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
