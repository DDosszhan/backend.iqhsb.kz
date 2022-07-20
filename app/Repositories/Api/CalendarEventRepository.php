<?php

namespace App\Repositories\Api;

use App\Models\CalendarEvent;
use Illuminate\Database\Eloquent\Model;

class CalendarEventRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(CalendarEvent $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model->select([
            'id',
            'title',
            'start_date',
            'end_date',
        ])
            ->orderBy('start_date')
            ->get()
            ->each(function ($model) {
                $model->image_url = $model->getFirstMediaUrl('default');
                $model->makeHidden('media');
                return $model;
            });
    }
}
