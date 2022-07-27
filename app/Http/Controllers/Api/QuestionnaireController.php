<?php

namespace App\Http\Controllers\Api;

use App\Enums\QuestionnaireGrade;
use App\Enums\QuestionnaireLanguage;
use App\Enums\QuestionnaireSource;
use App\Http\Controllers\Controller;
use App\Repositories\Api\QuestionnaireRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class QuestionnaireController extends Controller
{
    private QuestionnaireRepository $questionnaireRepository;

    public function __construct(QuestionnaireRepository $questionnaireRepository)
    {
        $this->questionnaireRepository = $questionnaireRepository;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'grade' => ['required', new Enum(QuestionnaireGrade::class)],
            'language' => ['required', new Enum(QuestionnaireLanguage::class)],
            'school' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'source' => ['required', new Enum(QuestionnaireSource::class)],
            'parent_name' => ['required', 'string', 'max:255'],
        ]);

        $this->questionnaireRepository->create($validatedData);

        return response(null, 204);
    }
}
