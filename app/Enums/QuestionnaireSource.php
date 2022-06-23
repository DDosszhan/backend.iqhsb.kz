<?php

namespace App\Enums;

enum QuestionnaireSource: string
{
    case Website = 'Сайт школы';
    case Social = 'Социальные сети';
    case Familiar = 'От знакомых/родственников';
    case Other = 'Другое';
}
