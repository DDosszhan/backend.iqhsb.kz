<?php

namespace App\Repositories\Admin;

use App\Models\SocialNetwork;
use Illuminate\Database\Eloquent\Model;

class SocialNetworkRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(SocialNetwork $model)
    {
        parent::__construct($model);
    }
}
