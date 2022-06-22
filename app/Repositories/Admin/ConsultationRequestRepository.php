<?php

namespace App\Repositories\Admin;

use App\Models\ConsultationRequest;
use Illuminate\Database\Eloquent\Model;

class ConsultationRequestRepository extends BaseAdminRepository
{
    protected Model $model;

    public function __construct(ConsultationRequest $model)
    {
        parent::__construct($model);
    }
}
