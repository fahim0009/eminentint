<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryApiController extends Controller
{
    public function getIndustries(Request $request)
    {
        // Optional: Allow API to request specific language (e.g. /api/industries?lang=ar)
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        // Fetch only active industries, ordered by the 'order' column
        $industries = Industry::where('status', 1)
                    ->orderBy('order', 'asc')
                    ->get();

        // Check if data exists
        if ($industries->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No industries found.'
            ], 404);
        }

        // Return formatted JSON response
        return response()->json([
            'success' => true,
            'message' => 'Industries retrieved successfully.',
            'data' => $industries
        ], 200);
    }
}