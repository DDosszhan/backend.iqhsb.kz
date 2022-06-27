<?php

namespace App\Repositories\Admin;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;

class PartnerRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(Partner $model)
    {
        parent::__construct($model);
    }
}
