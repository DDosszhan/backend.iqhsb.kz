<?php

namespace App\Repositories\Admin;

use App\Models\GraduateAchievement;

class GraduateAchievementRepository extends BaseAdminRepository
{
    protected $model = GraduateAchievement::class;

    public function getLastPosition()
    {
        return $this->getModel()->max('position') + 1;
    }
}
