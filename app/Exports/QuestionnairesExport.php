<?php

namespace App\Exports;

use App\Models\Questionnaire;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuestionnairesExport implements FromCollection
{
    public function collection(): Collection
    {
        return Questionnaire::all();
    }
}
