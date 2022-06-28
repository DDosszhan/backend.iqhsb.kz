<?php

namespace App\Repositories\Api;

use App\Models\University;
use Illuminate\Database\Eloquent\Model;

class UniversityRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(University $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model->select([
            'id',
            'name',
        ])
            ->orderBy('id', 'desc')
            ->get()
            ->each(function ($model) {
                $model->image_url = $model->getFirstMediaUrl('default');
                $model->makeHidden('media');
                return $model;
            });
    }
}
