<?php

namespace Tests\Feature;

use Tests\TestCase;

class ConsultationRequestTest extends TestCase
{
    public function test_add_consultation_request()
    {
        $formData = [
            'name' => 'Иван',
            'phone' => '77781111111',
        ];

        $response = $this->post(route('api.consultation-requests.store'), $formData);

        $response->assertStatus(204);
    }
}
