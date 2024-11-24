<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\VacanciesAppMail;

class JobApplicationController extends Controller
{
    public function apply(Request $request)
    {
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:30720', // max 30MB
        ]);

        // Отправка почты
        Mail::to('hr@iqhs.edu.kz')->send(new VacanciesAppMail($validatedData, $request->file('resume')));

        return response()->json(['message' => 'Application submitted successfully']);
    }
}
