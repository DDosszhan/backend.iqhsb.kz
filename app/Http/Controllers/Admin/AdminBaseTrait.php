<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ItemNotFoundException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

trait AdminBaseTrait
{
    private BaseRepository $repository;
    private LengthAwarePaginator $items;
    private Model $item;

    protected string $title;
    protected string $titleCreate;
    protected string $titleEdit;
    protected string $tableColumnCount;
    protected string $buttonSubmitCreate = 'Создать';
    protected string $buttonSubmitEdit = 'Обновить';
    protected string $buttonCancel = 'Отмена';

    protected string $routeList;
    protected string $routeCreate;
    protected string $routeStore;
    protected string $routeEdit;
    protected string $routeUpdate;
    protected string $routeDelete;

    protected string $viewIndex;
    protected string $viewList;
    protected string $viewForm;
    protected string $viewItem;

    abstract public function validationRules(): array;

    public function index(): Factory|View|Application
    {
        return view($this->viewIndex, [
            'title' => $this->title,
            'routeList' => $this->routeList,
            'routeCreate' => $this->routeCreate,
        ]);
    }

    public function list(): JsonResponse
    {
        $this->items = $this->repository->orderBy('id', 'desc')->paginate();

        return $this->listResponse();
    }

    public function create(): JsonResponse
    {
        return $this->createResponse();
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateStoreRequest($request->all());
        $this->item = $this->repository->create($validatedData);

        return $this->storeResponse();
    }

    public function edit(int $id): JsonResponse
    {
        $this->item = $this->findById($id);
        return $this->editResponse();
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->item = $this->findById($id);

        $validatedData = $this->validateUpdateRequest($request->all());
        $this->item->update($validatedData);

        return $this->updateResponse();
    }

    public function delete(int $id): JsonResponse
    {
        $this->findById($id)->delete();
        return $this->deleteResponse($id);
    }

    /**
     * @throws ItemNotFoundException
     */
    public function findById(int $id): Model
    {
        $item = $this->repository->find($id);

        if (!$item) {
            throw new ItemNotFoundException();
        }

        return $item;
    }

    public function listResponse(): JsonResponse
    {
        return response()->json([
            'functions' => [
                'updateTableContent' => [
                    'params' => [
                        'selector' => '.ajax-content',
                        'content' => view($this->viewList, [
                            'items' => $this->items,
                            'routeList' => $this->routeList,
                            'routeEdit' => $this->routeEdit,
                            'routeDelete' => $this->routeDelete,
                            'viewItem' => $this->viewItem,
                            'tableColumnCount' => $this->tableColumnCount,
                        ])->render(),
                        'pagination' => view('core::layouts.pagination', [
                            'links' => $this->items->links('core::pagination.bootstrap-4'),
                        ])->render(),
                    ]
                ]
            ]
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
                        ])->render(),
                    ]
                ]
            ]
        ]);
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
                'prependTableRow' => [
                    'params' => [
                        'selector' => '.ajax-content',
                        'content' => view($this->viewItem, [
                            'item' => $this->item,
                            'routeEdit' => $this->routeEdit,
                            'routeDelete' => $this->routeDelete,
                        ])->render()
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
                        ])->render(),
                    ]
                ]
            ]
        ]);
    }

    public function updateResponse(): JsonResponse
    {
        return response()->json([
            'functions' => [
                'closeModal' => [
                    'params' => [
                        'modal' => 'largeModal',
                    ]
                ],
                'updateTableRow' => [
                    'params' => [
                        'selector' => '.ajax-content',
                        'row' => '.row-' . $this->item->id,
                        'content' => view($this->viewItem, [
                            'item' => $this->item,
                            'routeEdit' => $this->routeEdit,
                            'routeDelete' => $this->routeDelete,
                        ])->render()
                    ]
                ]
            ]
        ]);
    }

    public function deleteResponse(int $id): JsonResponse
    {
        return response()->json([
            'functions' => [
                'deleteTableRow' => [
                    'params' => [
                        'selector' => '.ajax-content',
                        'row' => '.row-' . $id
                    ]
                ]
            ]
        ]);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateStoreRequest($validationData): array
    {
        $validator = Validator::make($validationData, $this->getValidationRulesForStore());
        $validator->validate();

        return $validator->validated();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateUpdateRequest($validationData): array
    {
        $validator = Validator::make($validationData, $this->getValidationRulesForUpdate());
        $validator->validate();

        return $validator->validated();
    }

    public function getValidationRulesForStore(): array
    {
        return $this->validationRules();
    }

    public function getValidationRulesForUpdate(): array
    {
        return $this->validationRules();
    }
}
