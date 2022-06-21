<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Repositories\Admin\GraduateAchievementRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GraduateAchievementController extends Controller
{
    use AdminBaseTrait;

    public function __construct(GraduateAchievementRepository $graduateAchievementRepository)
    {
        $this->repository = $graduateAchievementRepository;

        $this->title = 'Достижения выпускников';
        $this->titleCreate = 'Добавить достижение';
        $this->titleEdit = 'Редактировать достижение';
        $this->tableColumnCount = 7;

        $this->routeList = 'admin.graduate-achievements.list';
        $this->routeCreate = 'admin.graduate-achievements.create';
        $this->routeStore = 'admin.graduate-achievements.store';
        $this->routeEdit = 'admin.graduate-achievements.edit';
        $this->routeUpdate = 'admin.graduate-achievements.update';
        $this->routeDelete = 'admin.graduate-achievements.delete';

        $this->viewIndex = 'admin.graduate-achievements.index';
        $this->viewList = 'admin.graduate-achievements.list';
        $this->viewForm = 'admin.graduate-achievements.form';
        $this->viewItem = 'admin.graduate-achievements.item';
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

    public function createResponse(): JsonResponse
    {
        return response()->json([
            'functions' => [
                'updateModal' => [
                    'params' => [
                        'modal' => 'largeModal',
                        'title' => $this->titleCreate,
                        'content' => view($this->viewForm, [
                            'formAction' => route($this->routeStore),
                            'buttonSubmit' => $this->buttonSubmitCreate,
                            'buttonCancel' => $this->buttonCancel,
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
                        'title' => $this->titleEdit,
                        'content' => view($this->viewForm, [
                            'formAction' => route($this->routeUpdate, $this->item->id),
                            'buttonSubmit' => $this->buttonSubmitEdit,
                            'buttonCancel' => $this->buttonCancel,
                            'item' => $this->item,
                            'universities' => University::select(['id', 'name'])->get(),
                        ])->render(),
                    ]
                ]
            ]
        ]);
    }
}
