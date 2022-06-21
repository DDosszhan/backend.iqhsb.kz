<?php

namespace App\Repositories\Admin;

use App\Models\University;
use Illuminate\Database\Eloquent\Model;

class UniversityRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(University $model)
    {
        parent::__construct($model);
    }
}
