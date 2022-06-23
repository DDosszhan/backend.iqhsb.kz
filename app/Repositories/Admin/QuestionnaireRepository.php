<?php

namespace App\Repositories\Admin;

use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(Questionnaire $model)
    {
        parent::__construct($model);
    }
}
