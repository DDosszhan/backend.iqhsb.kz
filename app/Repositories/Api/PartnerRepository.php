<?php

namespace App\Repositories\Api;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;

class PartnerRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(Partner $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model->select([
            'id',
            'name',
            'company',
            'description',
        ])
            ->orderBy('position')
            ->get()
            ->each(function ($model) {
                $model->image_url = $model->getFirstMediaUrl('default');
                $model->makeHidden('media');
                return $model;
            });
    }
}
