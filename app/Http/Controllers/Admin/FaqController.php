<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\FaqRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use StarterKit\Core\Traits\AdminBase;

class FaqController extends Controller
{
    use AdminBase;

    public function __construct(FaqRepository $repository)
    {
        $this->repository = $repository;
    }

    public function initConfig(): array
    {
        return [
            'title' => [
                'list' => 'Частые вопросы',
                'create' => 'Создать вопрос',
                'edit' => 'Редактировать вопрос',
            ],
            'route' => [
                'list' => 'admin.faqs.list',
                'create' => 'admin.faqs.create',
                'store' => 'admin.faqs.store',
                'edit' => 'admin.faqs.edit',
                'update' => 'admin.faqs.update',
                'delete' => 'admin.faqs.delete',
            ],
            'view' => [
                'index' => 'admin.faqs.index',
                'list' => 'admin.faqs.list',
                'form' => 'admin.faqs.form',
                'item' => 'admin.faqs.item',
            ],
        ];
    }

    public function validationRules(): array
    {
        $defaultLocale = app()->getLocale();
        $locales = implode(',', config('project.locales'));

        return [
            'question' => ['required', "array:$locales"],
            "question.$defaultLocale" => ['required', 'string', 'max:255'],
            'answer' => ['required', "array:$locales"],
            "answer.$defaultLocale" => ['required', 'string', 'max:255'],
            'active' => ['sometimes', 'required', 'accepted'],
        ];
    }

    public function list(): JsonResponse
    {
        $this->items = $this->repository->getModel()->orderBy('position')->paginate();

        return $this->listResponse();
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $validatedData['position'] = $this->repository->getLastPosition();

        $this->item = $this->repository->getModel()->create($validatedData);

        return $this->storeResponse();
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
