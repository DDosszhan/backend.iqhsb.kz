<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

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
}
