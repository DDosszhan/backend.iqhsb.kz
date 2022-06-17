<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\FaqRepository;
use Illuminate\Http\JsonResponse;

class FaqController extends Controller
{
    use AdminBaseTrait;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->repository = $faqRepository;

        $this->title = 'Частые вопросы';
        $this->titleCreate = 'Создать вопрос';
        $this->titleEdit = 'Редактировать вопрос';
        $this->tableColumnCount = 5;

        $this->routeList = 'admin.faqs.list';
        $this->routeCreate = 'admin.faqs.create';
        $this->routeStore = 'admin.faqs.store';
        $this->routeEdit = 'admin.faqs.edit';
        $this->routeUpdate = 'admin.faqs.update';
        $this->routeDelete = 'admin.faqs.delete';

        $this->viewIndex = 'admin.faqs.index';
        $this->viewList = 'admin.faqs.list';
        $this->viewForm = 'admin.faqs.form';
        $this->viewItem = 'admin.faqs.item';
    }

    public function validationRules(): array
    {
        $locale = config('app.locale');

        return [
            'question' => ['required', 'array'],
            "question.$locale" => ['required', 'string', 'max:255'],
            'answer' => ['required', 'array'],
            "answer.$locale" => ['required', 'string', 'max:255'],
            'active' => ['sometimes', 'required', 'accepted'],
        ];
    }

    public function list(): JsonResponse
    {
        $this->items = $this->repository->orderBy('position')->paginate();

        return $this->listResponse();
    }

    public function positionUp(int $id)
    {
        $items = $this->repository->orderBy('position')->get();

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
        $items = $this->repository->orderBy('position')->get();

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
