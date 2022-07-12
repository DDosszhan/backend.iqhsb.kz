<?php

namespace App\Exports;

use App\Models\ConsultationRequest;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConsultationRequestsExport implements FromCollection
{
    public function collection(): Collection
    {
        return ConsultationRequest::all();
    }
}
