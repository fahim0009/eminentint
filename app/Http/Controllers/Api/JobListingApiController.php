<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingApiController extends Controller
{
    public function getJobListings(Request $request)
    {
        // Optional: Allow API to request specific language (e.g. /api/job-listings?lang=ar)
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        // Fetch only active jobs, ordered by the 'order' column
        $jobs = JobListing::where('status', 1)
                    ->orderBy('order', 'asc')
                    ->orderBy('id', 'desc')
                    ->get();

        // Check if data exists
        if ($jobs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No active job listings found.'
            ], 404);
        }

        // Return formatted JSON response
        return response()->json([
            'success' => true,
            'message' => 'Job listings retrieved successfully.',
            'data' => $jobs
        ], 200);
    }
}