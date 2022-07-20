<?php

namespace App\Models;

use App\ModelFilters\ConsultationRequestFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConsultationRequest extends BaseModel
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
