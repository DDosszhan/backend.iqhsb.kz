<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function get()
    {
        return $this->model->get();
    }

    public function create(array $attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function find(mixed $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function findOrFail(mixed $id, array $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function orderBy(string $column, string $direction = 'asc')
    {
        return $this->model->orderBy($column, $direction);
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }

    public function select($columns)
    {
        return $this->model->select($columns);
    }

    public function paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
    {
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }
}
