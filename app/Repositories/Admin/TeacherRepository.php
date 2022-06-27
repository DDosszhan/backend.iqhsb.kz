<?php

namespace App\Repositories\Admin;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class TeacherRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(Teacher $model)
    {
        parent::__construct($model);
    }
}
