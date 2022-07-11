<?php

namespace App\Repositories\Api;

use App\Models\ExampleFile;
use Illuminate\Database\Eloquent\Model;

class ExampleFileRepository extends BaseApiRepository
{
    protected Model $model;

    public function __construct(ExampleFile $model)
    {
        parent::__construct($model);
    }
}
