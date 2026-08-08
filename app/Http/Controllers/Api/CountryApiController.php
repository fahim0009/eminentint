<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryApiController extends Controller
{
    public function getCountries(Request $request)
    {
        // Set locale if passed in API (e.g. /api/countries?lang=ar)
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        // Fetch active countries, featured first, then by order
        $countries = Country::where('status', 1)
                    ->orderBy('is_featured', 'desc')
                    ->orderBy('order', 'asc')
                    ->get();

        if ($countries->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No countries found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Countries retrieved successfully.',
            'data' => $countries
        ], 200);
    }
}