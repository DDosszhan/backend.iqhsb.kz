<?php

namespace App\Repositories\Admin;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Model;

class BannerRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(Banner $model)
    {
        parent::__construct($model);
    }
}
