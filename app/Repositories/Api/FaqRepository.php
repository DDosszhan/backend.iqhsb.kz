<?php

namespace App\Repositories\Api;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Model;

class FaqRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }

    public function get()
    {
        return $this->model->select([
            'id',
            'question',
            'answer',
        ])
            ->where('active', true)
            ->orderBy('position')
            ->get();
    }
}
