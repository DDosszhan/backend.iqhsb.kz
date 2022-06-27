<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\TeacherRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use AdminBaseTrait;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->repository = $teacherRepository;

        $this->title = 'Преподавательский состав';
        $this->titleCreate = 'Добавить предодавателя';
        $this->titleEdit = 'Редактировать преподавателя';
        $this->tableColumnCount = 5;

        $this->routeList = 'admin.teachers.list';
        $this->routeCreate = 'admin.teachers.create';
        $this->routeStore = 'admin.teachers.store';
        $this->routeEdit = 'admin.teachers.edit';
        $this->routeUpdate = 'admin.teachers.update';
        $this->routeDelete = 'admin.teachers.delete';

        $this->viewIndex = 'admin.teachers.index';
        $this->viewList = 'admin.teachers.list';
        $this->viewForm = 'admin.teachers.form';
        $this->viewItem = 'admin.teachers.item';
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
