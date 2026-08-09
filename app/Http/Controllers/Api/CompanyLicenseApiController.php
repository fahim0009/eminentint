<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyLicense;
use Illuminate\Http\Request;

class CompanyLicenseApiController extends Controller
{
    public function getLicenses(Request $request)
    {
        // Optional: Allow API to request specific language (e.g. /api/licenses?lang=ar)
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        // Fetch only active licenses, ordered by the 'order' column
        $licenses = CompanyLicense::where('status', 1)
                    ->orderBy('order', 'asc')
                    ->get();

        // Check if data exists
        if ($licenses->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No licenses found.'
            ], 404);
        }

        // Return formatted JSON response
        return response()->json([
            'success' => true,
            'message' => 'Licenses retrieved successfully.',
            'data' => $licenses
        ], 200);
    }
}