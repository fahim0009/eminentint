<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CandidateApplication;

class CandidateApplicationApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'target_position' => 'required|string|max:255',
            'destination_country' => 'nullable|string|max:255',
            'job_listing_id' => 'nullable|string|max:255',
            'experience_level' => 'nullable|string|max:255',
            'passport_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120', // 5MB Max
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB Max
        ]);

        $uploadPath = public_path('uploads/candidates/');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $passportFilePath = null;
        $cvFilePath = null;

        // Handle Passport Upload
        if ($request->hasFile('passport_file')) {
            $passportFile = $request->file('passport_file');
            $passportFileName = time() . '_passport_' . $passportFile->getClientOriginalName();
            $passportFile->move($uploadPath, $passportFileName);
            $passportFilePath = '/uploads/candidates/' . $passportFileName;
        }

        // Handle CV Upload
        if ($request->hasFile('cv_file')) {
            $cvFile = $request->file('cv_file');
            $cvFileName = time() . '_cv_' . $cvFile->getClientOriginalName();
            $cvFile->move($uploadPath, $cvFileName);
            $cvFilePath = '/uploads/candidates/' . $cvFileName;
        }

        // Save to database
        $application = CandidateApplication::create([
            'full_name' => $validated['full_name'],
            'passport_number' => $validated['passport_number'],
            'phone' => $validated['phone'],
            'target_position' => $validated['target_position'],
            'job_listing_id' => $validated['job_listing_id'] ?? null,
            'destination_country' => $validated['destination_country'] ?? null,
            'experience_level' => $validated['experience_level'] ?? null,
            'passport_file' => $passportFilePath,
            'cv_file' => $cvFilePath,
        ]);

        return response()->json([
            'message' => 'Application submitted successfully!',
            'tracking_id' => $application->tracking_id
        ], 201);
    }
}