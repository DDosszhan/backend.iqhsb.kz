<?php

namespace App\Http\Controllers\Admin;

use App\Enums\QuestionnaireGrade;
use App\Enums\QuestionnaireLanguage;
use App\Enums\QuestionnaireSource;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\QuestionnaireRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class QuestionnaireController extends Controller
{
    use AdminBaseTrait;

    public function __construct(QuestionnaireRepository $questionnaireRepository)
    {
        $this->repository = $questionnaireRepository;

        $this->title = 'Анкеты на поступление';
        $this->titleCreate = 'Создать анкету'; // lol
        $this->titleEdit = 'Редактировать анкету';
        $this->tableColumnCount = 12;

        $this->routeList = 'admin.questionnaires.list';
        $this->routeCreate = 'admin.questionnaires.create';
        $this->routeStore = 'admin.questionnaires.store';
        $this->routeEdit = 'admin.questionnaires.edit';
        $this->routeUpdate = 'admin.questionnaires.update';
        $this->routeDelete = 'admin.questionnaires.delete';

        $this->viewIndex = 'admin.questionnaires.index';
        $this->viewList = 'admin.questionnaires.list';
        $this->viewForm = 'admin.questionnaires.form';
        $this->viewItem = 'admin.questionnaires.item';
    }

    public function validationRules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'string', 'max:255'],
            'grade' => ['required', new Enum(QuestionnaireGrade::class)],
            'language' => ['required', new Enum(QuestionnaireLanguage::class)],
            'school' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'source' => ['required', new Enum(QuestionnaireSource::class)],
            'parent_name' => ['required', 'string', 'max:255'],
        ];
    }
}
