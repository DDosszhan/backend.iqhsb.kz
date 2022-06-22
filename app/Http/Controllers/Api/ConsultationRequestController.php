<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\ConsultationRequestRepository;
use Illuminate\Http\Request;

class ConsultationRequestController extends Controller
{
    private ConsultationRequestRepository $consultationRequestRepository;

    public function __construct(ConsultationRequestRepository $consultationRequestRepository)
    {
        $this->consultationRequestRepository = $consultationRequestRepository;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        $this->consultationRequestRepository->create($validatedData);

        return response(null, 204);
    }
}
