<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarEventTest extends TestCase
{
    public function test_get_calendar_events()
    {
        $response = $this->getJson(route('api.calendar-events.index'));
        $response->assertStatus(200);
    }
}
