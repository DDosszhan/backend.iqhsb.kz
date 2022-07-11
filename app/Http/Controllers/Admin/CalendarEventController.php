<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CalendarEventRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use StarterKit\Core\Traits\AdminBase;

class CalendarEventController extends Controller
{
    use AdminBase;

    public function __construct(CalendarEventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Академический календарь',
                'create' => 'Создать событие в календаре',
                'edit' => 'Редактировать событие в календаре',
            ],
            'route' => [
                'list' => 'admin.calendar-events.list',
                'create' => 'admin.calendar-events.create',
                'store' => 'admin.calendar-events.store',
                'edit' => 'admin.calendar-events.edit',
                'update' => 'admin.calendar-events.update',
                'delete' => 'admin.calendar-events.delete',
            ],
            'view' => [
                'index' => 'admin.calendar-events.index',
                'list' => 'admin.calendar-events.list',
                'form' => 'admin.calendar-events.form',
                'item' => 'admin.calendar-events.item',
            ],
            'cropper' => [
                'width' => 250,
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
            'title' => ["array:$locales"],
            "title.$defaultLocale" => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date_format:Y-m-d'],
            'end_date' => ['nullable', 'date_format:Y-m-d', 'after:start_date'],
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
}
