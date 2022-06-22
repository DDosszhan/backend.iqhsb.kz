<?php

namespace App\Repositories\Api;

use App\Models\ConsultationRequest;
use Illuminate\Database\Eloquent\Model;

class ConsultationRequestRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(ConsultationRequest $model)
    {
        parent::__construct($model);
    }
}
