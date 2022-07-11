<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Repositories\Admin\GraduateAchievementRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use StarterKit\Core\Traits\AdminBase;

class GraduateAchievementController extends Controller
{
    use AdminBase;

    public function __construct(GraduateAchievementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function setConfig(): array
    {
        return [
            'title' => [
                'list' => 'Достижения выпускников',
                'create' => 'Добавить достижение',
                'edit' => 'Редактировать достижение',
            ],
            'route' => [
                'list' => 'admin.graduate-achievements.list',
                'create' => 'admin.graduate-achievements.create',
                'store' => 'admin.graduate-achievements.store',
                'edit' => 'admin.graduate-achievements.edit',
                'update' => 'admin.graduate-achievements.update',
                'delete' => 'admin.graduate-achievements.delete',
            ],
            'view' => [
                'index' => 'admin.graduate-achievements.index',
                'list' => 'admin.graduate-achievements.list',
                'form' => 'admin.graduate-achievements.form',
                'item' => 'admin.graduate-achievements.item',
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
            'university_id' => ['exists:universities,id'],
            'graduate_name' => ['required', "array:ru,gg,kk,ff,aa,en"],
            "graduate_name.$defaultLocale" => ['required', 'string', 'max:255'],
            'description' => ['required', "array:$locales"],
            "description.$defaultLocale" => ['required', 'string', 'max:10000'],
            'city' => ['required', "array:$locales"],
            "city.$defaultLocale" => ['required', 'string', 'max:255'],
            'year' => ['required', 'digits:4', 'integer', 'min:1900', 'max:' . ((int)date('Y') + 1)],
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

    public function createResponse(): JsonResponse
    {
        return response()->json([
            'functions' => [
                'updateModal' => [
                    'params' => [
                        'modal' => 'largeModal',
                        'title' => $this->config('title.create'),
                        'content' => view($this->config('view.form'), [
                            'formAction' => route($this->config('route.store')),
                            'config' => $this->config(),
                            'universities' => University::select(['id', 'name'])->get(),
                        ])->render(),
                    ]
                ]
            ]
        ]);
    }

    public function editResponse(): JsonResponse
    {
        return response()->json([
            'functions' => [
                'updateModal' => [
                    'params' => [
                        'modal' => 'largeModal',
                        'title' => $this->config('title.edit'),
                        'content' => view($this->config('view.form'), [
                            'formAction' => route($this->config('route.update'), $this->item->id),
                            'config' => $this->config(),
                            'item' => $this->item,
                            'universities' => University::select(['id', 'name'])->get(),
                        ])->render(),
                    ]
                ]
            ]
        ]);
    }
}
