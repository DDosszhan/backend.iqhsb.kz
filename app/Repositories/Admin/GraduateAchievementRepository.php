<?php

namespace App\Repositories\Admin;

use App\Models\GraduateAchievement;
use Illuminate\Database\Eloquent\Model;

class GraduateAchievementRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(GraduateAchievement $model)
    {
        parent::__construct($model);
    }
}
