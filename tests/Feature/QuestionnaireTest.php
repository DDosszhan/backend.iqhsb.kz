<?php

namespace Tests\Feature;

use Tests\TestCase;

class QuestionnaireTest extends TestCase
{
    public function test_add_questionnaire()
    {
        $formData = [
            'last_name' => 'Иванов',
            'first_name' => 'Иван',
            'date_of_birth' => '2022-06-22',
            'grade' => '10',
            'language' => 'Русский',
            'school' => 'Школа №1',
            'phone' => '77781111111',
            'email' => 'user@example.com',
            'source' => 'Сайт школы',
            'parent_name' => 'Иванов Иван Неиванович'
        ];

        $response = $this->post(route('api.questionnaires.store'), $formData);

        $response->assertStatus(204);
    }
}
