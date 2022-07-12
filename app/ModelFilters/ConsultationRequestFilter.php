<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class ConsultationRequestFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function name($name)
    {
        return $this->where('name', 'iLIKE', "%$name%");
    }

    public function phone($phone)
    {
        return $this->where('phone', 'iLIKE', "%$phone%");
    }

    public function createdAt($createdAt)
    {
        $createdAt = Carbon::parse($createdAt)->toDateString();
        return $this->where('created_at', 'LIKE', "$createdAt%");
    }
}
