<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceApiController extends Controller
{
    public function getServices(Request $request)
    {
        // Optional: Allow API to request specific language (e.g. /api/services?lang=ar)
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        // Fetch only active services, ordered by the 'order' column
        $services = Service::where('status', 1)
                    ->orderBy('order', 'asc')
                    ->get();

        // Check if data exists
        if ($services->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No services found.'
            ], 404);
        }

        // Return formatted JSON response
        return response()->json([
            'success' => true,
            'message' => 'Services retrieved successfully.',
            'data' => $services
        ], 200);
    }
}