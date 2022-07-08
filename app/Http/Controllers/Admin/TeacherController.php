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

    public function setConfig(): array
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
            'image' => ['required', 'image'],
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $this->item = $this->repository->getModel()->create($validatedData);
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
