<?php

namespace App\Models;

use App\ModelFilters\QuestionnaireFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'last_name',
        'first_name',
        'date_of_birth',
        'grade',
        'language',
        'school',
        'phone',
        'email',
        'source',
        'parent_name',
    ];
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function modelFilter()
    {
        return $this->provideFilter(QuestionnaireFilter::class);
    }
}
