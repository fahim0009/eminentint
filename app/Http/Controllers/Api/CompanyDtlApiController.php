<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyDetails;
use Illuminate\Http\Request;

class CompanyDtlApiController extends Controller
{
    public function getCompanyDetails(Request $request)
    {
        // Fetch the first record
        $company = CompanyDetails::first();

        // Check if data exists
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company details not found.'
            ], 404);
        }

        // Optional: Allow API to request specific language (e.g. /api/company-details?lang=ar)
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        // Return formatted JSON response
        return response()->json([
            'success' => true,
            'message' => 'Company details retrieved successfully.',
            'data' => $company
        ], 200);
    }
}