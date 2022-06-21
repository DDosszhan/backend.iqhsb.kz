<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\UniversityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    use AdminBaseTrait;

    public function __construct(UniversityRepository $universityRepository)
    {
        $this->repository = $universityRepository;

        $this->title = 'Университеты';
        $this->titleCreate = 'Создать универститет';
        $this->titleEdit = 'Редактировать универститет';
        $this->tableColumnCount = 4;

        $this->routeList = 'admin.universities.list';
        $this->routeCreate = 'admin.universities.create';
        $this->routeStore = 'admin.universities.store';
        $this->routeEdit = 'admin.universities.edit';
        $this->routeUpdate = 'admin.universities.update';
        $this->routeDelete = 'admin.universities.delete';

        $this->viewIndex = 'admin.universities.index';
        $this->viewList = 'admin.universities.list';
        $this->viewForm = 'admin.universities.form';
        $this->viewItem = 'admin.universities.item';
    }

    public function validationRules(): array
    {
        $defaultLocale = app()->getLocale();
        $locales = implode(',', config('project.locales'));

        return [
            'name' => ['required', "array:$locales"],
            "name.$defaultLocale" => ['required', 'string', 'max:255'],
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
}
