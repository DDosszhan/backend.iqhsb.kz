<?php

namespace App\Repositories\Admin;

use App\Models\CalendarEvent;
use Illuminate\Database\Eloquent\Model;

class CalendarEventRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(CalendarEvent $model)
    {
        parent::__construct($model);
    }
}
