<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\GraduateAchievementRepository;

class GraduateAchievementController extends Controller
{
    private GraduateAchievementRepository $graduateAchievementRepository;

    public function __construct(GraduateAchievementRepository $graduateAchievementRepository)
    {
        $this->graduateAchievementRepository = $graduateAchievementRepository;
    }

    public function index()
    {
        $response =$this->graduateAchievementRepository->get();
        return response()->json($response);
    }
}
