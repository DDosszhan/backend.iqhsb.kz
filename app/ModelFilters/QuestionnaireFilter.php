<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class QuestionnaireFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function grade($grade)
    {
        return $this->where('grade', $grade);
    }

    public function language($language)
    {
        return $this->where('language', $language);
    }

    public function source($source)
    {
        return $this->where('source', $source);
    }

    public function school($school)
    {
        return $this->where('school', 'iLIKE', "%$school%");
    }

    public function lastName($lastName)
    {
        return $this->where('last_name', 'iLIKE', "%$lastName%");
    }

    public function firstName($firstName)
    {
        return $this->where('first_name', 'iLIKE', "%$firstName%");
    }

    public function phone($phone)
    {
        return $this->where('phone', 'iLIKE', "%$phone%");
    }

    public function email($email)
    {
        return $this->where('email', 'iLIKE', "%$email%");
    }

    public function parentName($parentName)
    {
        return $this->where('parent_name', 'iLIKE', "%$parentName%");
    }

    public function dateOfBirth($dateOfBirth)
    {
        $dateOfBirth = Carbon::parse($dateOfBirth)->toDateString();
        return $this->where('date_of_birth', 'LIKE', "$dateOfBirth%");
    }

    public function createdAt($createdAt)
    {
        $createdAt = Carbon::parse($createdAt)->toDateString();
        return $this->where('created_at', 'LIKE', "$createdAt%");
    }
}
