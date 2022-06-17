<?php

namespace App\Repositories\Admin;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Model;

class FaqRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }
}
