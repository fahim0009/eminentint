<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DualFeature;
use Illuminate\Http\JsonResponse;

class DualFeatureApiController extends Controller
{
    public function getDualFeature(): JsonResponse
    {
        $data = DualFeature::first();

        if (!$data) {
            return response()->json(['message' => 'Dual Feature data not found'], 404);
        }

        return response()->json($data);
    }
}