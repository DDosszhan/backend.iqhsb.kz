<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\TeacherRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use StarterKit\Core\Traits\AdminBase;

class TeacherController extends Controller
{
    use AdminBase;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->repository = $teacherRepository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Преподавательский состав',
                'create' => 'Добавить предодавателя',
                'edit' => 'Редактировать преподавателя',
            ],
            'route' => [
                'list' => 'admin.teachers.list',
                'create' => 'admin.teachers.create',
                'store' => 'admin.teachers.store',
                'edit' => 'admin.teachers.edit',
                'update' => 'admin.teachers.update',
                'delete' => 'admin.teachers.delete',
            ],
            'view' => [
                'index' => 'admin.teachers.index',
                'list' => 'admin.teachers.list',
                'form' => 'admin.teachers.form',
                'item' => 'admin.teachers.item',
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
            'position' => ['required', "array:$locales"],
            "position.$defaultLocale" => ['required', 'string', 'max:255'],
            'cropper' => ['required', 'image'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $validatedData['order'] = $this->repository->getLastPosition();
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
        $this->items = $this->repository->getModel()->orderBy('order')->paginate(100);

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
        $items = $this->repository->getModel()->orderBy('order')->get();

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
        $items = $this->repository->getModel()->orderBy('order')->get();

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
