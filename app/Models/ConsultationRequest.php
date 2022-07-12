<?php

namespace App\Models;

use App\ModelFilters\ConsultationRequestFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function modelFilter()
    {
        return $this->provideFilter(ConsultationRequestFilter::class);
    }
}
