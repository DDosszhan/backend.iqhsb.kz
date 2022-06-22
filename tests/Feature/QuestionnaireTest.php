<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionnaireTest extends TestCase
{
    use DatabaseMigrations;

    public function test_questionnaires()
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
