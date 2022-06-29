<?php

namespace App\Repositories\Api;

use App\Models\SocialNetwork;
use Illuminate\Database\Eloquent\Model;

class SocialNetworkRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(SocialNetwork $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model
            ->select(['name', 'url'])
            ->get()
            ->mapWithKeys(function ($item, $key) {
                return [$item->name => $item->url];
            });
    }
}
