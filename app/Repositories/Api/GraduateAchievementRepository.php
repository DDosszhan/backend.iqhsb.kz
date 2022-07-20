<?php

namespace App\Repositories\Api;

use App\Models\GraduateAchievement;
use Illuminate\Database\Eloquent\Model;

class GraduateAchievementRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(GraduateAchievement $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model->select([
            'id',
            'university_id',
            'graduate_name',
            'description',
            'year',
            'city',
        ])
            ->orderBy('position')
            ->with('university', function ($query) {
                $query->select(['id', 'name']);
            })
            ->get()
            ->each(function ($model) {
                $model->image_url = $model->getFirstMediaUrl('default');
                $model->university->image_url = $model->university->getFirstMediaUrl('default');
                $model->makeHidden('media');
                $model->makeHidden('university_id');
                $model->university->makeHidden('media');
                return $model;
            });
    }
}
