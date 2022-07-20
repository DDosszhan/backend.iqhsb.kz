<?php

namespace App\Repositories\Admin;

use App\Models\Teacher;

class TeacherRepository extends BaseAdminRepository
{
    protected $model = Teacher::class;

    public function getLastPosition()
    {
        return $this->getModel()->max('order') + 1;
    }
}
