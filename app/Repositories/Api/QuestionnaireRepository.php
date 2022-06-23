<?php

namespace App\Repositories\Api;

use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(Questionnaire $model)
    {
        parent::__construct($model);
    }
}
