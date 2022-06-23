<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\CalendarEventRepository;

class CalendarEventController extends Controller
{
    private CalendarEventRepository $calendarEventRepository;

    public function __construct(CalendarEventRepository $calendarEventRepository)
    {
        $this->calendarEventRepository = $calendarEventRepository;
    }

    public function index()
    {
        $response = $this->calendarEventRepository->get();
        return response()->json($response);
    }
}
