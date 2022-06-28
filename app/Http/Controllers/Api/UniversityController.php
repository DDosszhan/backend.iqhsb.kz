<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\UniversityRepository;

class UniversityController extends Controller
{
    private UniversityRepository $partnerRepository;

    public function __construct(UniversityRepository $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    public function index()
    {
        $response = $this->partnerRepository->get();
        return response()->json($response);
    }
}
