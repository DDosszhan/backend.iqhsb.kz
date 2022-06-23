<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CalendarEventRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    use AdminBaseTrait;

    public function __construct(CalendarEventRepository $calendarEventRepository)
    {
        $this->repository = $calendarEventRepository;

        $this->title = 'Академический календарь';
        $this->titleCreate = 'Создать событие в календаре';
        $this->titleEdit = 'Редактировать событие в календаре';
        $this->tableColumnCount = 6;

        $this->routeList = 'admin.calendar-events.list';
        $this->routeCreate = 'admin.calendar-events.create';
        $this->routeStore = 'admin.calendar-events.store';
        $this->routeEdit = 'admin.calendar-events.edit';
        $this->routeUpdate = 'admin.calendar-events.update';
        $this->routeDelete = 'admin.calendar-events.delete';

        $this->viewIndex = 'admin.calendar-events.index';
        $this->viewList = 'admin.calendar-events.list';
        $this->viewForm = 'admin.calendar-events.form';
        $this->viewItem = 'admin.calendar-events.item';
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
