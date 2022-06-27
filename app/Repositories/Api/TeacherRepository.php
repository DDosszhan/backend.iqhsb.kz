<?php

namespace App\Repositories\Api;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class TeacherRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(Teacher $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model->select([
            'id',
            'name',
            'position',
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
